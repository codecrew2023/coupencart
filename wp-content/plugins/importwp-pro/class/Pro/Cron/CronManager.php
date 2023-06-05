<?php

namespace ImportWP\Pro\Cron;

use ImportWP\Common\Importer\State\ImporterState;
use ImportWP\Common\Model\ImporterModel;
use ImportWP\Common\Util\Logger;
use ImportWP\Common\Util\Util;
use ImportWP\EventHandler;
use ImportWP\Pro\Importer\ImporterManager;

/**
 * CronManager hooks into the WordPress cron to run scheduled Imports.
 */
class CronManager
{
    /**
     * Scheduled event action hook name.
     *
     * @var string
     */
    private $_cron_main_handle = 'iwp_cron_runner';

    /**
     * @var ImporterManager
     */
    private $importer_manager;

    /**
     * @var EventHandler
     */
    protected $event_handler;

    /**
     * @param ImporterManager $importer_manager
     * @param EventHandler $event_handler
     */
    public function __construct(ImporterManager $importer_manager, $event_handler)
    {
        $this->importer_manager = $importer_manager;
        $this->event_handler = $event_handler;

        add_action('init', [$this, 'register_cron_runner']);
        add_filter('cron_schedules', [$this, 'register_cron_interval']);

        add_action($this->_cron_main_handle, [$this, 'import']);

        $this->event_handler->listen('iwp/importer/status/output', [$this, 'update_status_message']);
    }

    /**
     * Register custom 60 second cron schedule.
     *
     * @param array $schedules
     * @return void
     */
    public function register_cron_interval($schedules)
    {
        $schedules['iwp_spawner'] = [
            'interval' => MINUTE_IN_SECONDS,
            'display' => __('Every minutes.', 'importwp')
        ];
        return $schedules;
    }

    /**
     * Schedule WordPress action hook to use custom 60 second schedule.
     *
     * @return void
     */
    public function register_cron_runner()
    {
        if (!wp_next_scheduled($this->_cron_main_handle)) {
            wp_schedule_event(time(), 'iwp_spawner', $this->_cron_main_handle);
        }

        // Remove deprecated cron actions
        if (wp_next_scheduled('iwp_scheduler')) {
            wp_unschedule_hook('iwp_scheduler');
        }
        if (wp_next_scheduled('iwp_schedule_runner')) {
            wp_unschedule_hook('iwp_schedule_runner');
        }
    }

    public function import()
    {
        Logger::setRequestType('cron');

        $scheduled_importers = $this->get_scheduled_imports();
        if (empty($scheduled_importers)) {
            return;
        }

        // Order by scheduled time, prioritising where last_run is greater than time
        // check to see if there are any running imports?
        usort($scheduled_importers, function ($item1, $item2) {

            if ($item1['time'] <= $item1['last_ran'] && $item2['time'] > $item2['last_ran']) {
                return -1;
            } elseif ($item2['time'] <= $item2['last_ran'] && $item1['time'] > $item1['last_ran']) {
                return 1;
            }

            if ($item1['time'] == $item2['time']) return 0;
            return $item1['time'] < $item2['time'] ? -1 : 1;
        });

        $user = uniqid('iwp', true);

        foreach ($scheduled_importers as $importer) {

            $importer_model = $importer['importer'];
            $importer_id = $importer_model->getId();
            $this->importer_manager->set_current_user($importer_model);
            Logger::setId($importer_id);

            $init_importer = $importer['time'] > (int)get_post_meta($importer_id, '_iwp_cron_last_ran', true);

            if ($init_importer) {

                update_post_meta($importer_id, '_iwp_cron_last_ran', time());

                Logger::info('cron -start');

                // Clear existing import
                ImporterState::clear_options($importer_model->getId());

                $datasource = $importer_model->getDatasource();
                switch ($datasource) {
                    case 'remote':
                        $raw_source = $importer_model->getDatasourceSetting('remote_url');
                        $source = apply_filters('iwp/importer/datasource', $raw_source, $raw_source, $importer_model);
                        $source = apply_filters('iwp/importer/datasource/remote', $source, $raw_source, $importer_model);
                        $attachment_id = $this->importer_manager->remote_file($importer_model, $source, $importer_model->getParser());
                        break;
                    case 'local':
                        $raw_source = $importer_model->getDatasourceSetting('local_url');
                        $source = apply_filters('iwp/importer/datasource', $raw_source, $raw_source, $importer_model);
                        $source = apply_filters('iwp/importer/datasource/local', $source, $raw_source, $importer_model);
                        $attachment_id = $this->importer_manager->local_file($importer_model, $source);
                        break;
                    default:
                        // TODO: record error 
                        $attachment_id = new \WP_Error('IWP_CRON_1', 'Unable to get new file using datasource: ' . $datasource);
                        break;
                }

                $importer_model = $this->importer_manager->get_importer($importer_id);

                // This is used for storing version on imported records
                $session = md5($importer_model->getId() . time());
                update_post_meta($importer_model->getId(), '_iwp_session', $session);

                if (is_wp_error($attachment_id)) {

                    $state = ImporterState::wait_for_lock($importer_model->getId(), $user, function () use ($importer_model, $attachment_id, $session) {
                        $state = ImporterState::get_state($importer_model->getId());
                        $state['status'] = 'error';
                        $state['id'] = $session;
                        $state['message'] = $attachment_id->get_error_message();
                        return $state;
                    });

                    $tmp = new ImporterState($importer_model->getId(), $user);
                    $tmp->populate($state);

                    Util::write_status_session_to_file($importer_model->getId(), $tmp);
                    $this->cleanup($importer_model->getId());
                    return;
                }
            } else {

                // Importer status must be running
                $state = ImporterState::get_state($importer_id);
                if (!$state) {
                    $this->cleanup($importer_id);
                    return;
                }

                // if cancelled or error, cleanup and exit.
                switch ($state['status']) {
                    case 'error':
                    case 'cancelled':
                        $this->cleanup($importer_id);
                        return;
                }

                if ($state['status'] !== 'running') {
                    return;
                }

                update_post_meta($importer_id, '_iwp_cron_last_ran', time());
                Logger::info('cron -resume');

                $config = get_site_option('iwp_importer_config_' . $importer_id);
                $session = $config['id'];
            }

            $update_timestamp = function ($importer_status) use ($importer_id) {
                update_post_meta($importer_id, '_iwp_cron_last_ran', time());
            };

            add_action('iwp/importer/status/save', $update_timestamp);
            $state = $this->importer_manager->import($importer_id, $user, $session);
            remove_action('iwp/importer/status/save', $update_timestamp);

            Logger::info('cron -end');

            if (in_array($state['status'], ['init', 'running'])) {
                break;
            } else {
                $this->cleanup($importer_id);
            }
        }
    }

    /**
     * Generate importer scheduled dates.
     * @return array List of scheduled importers
     */
    public function get_scheduled_imports()
    {
        $query = new \WP_Query([
            'post_type' => IWP_POST_TYPE,
            'posts_per_page' => -1,
        ]);

        if (!$query->have_posts()) {
            return false;
        }

        $scheduled_importers = [];

        /**
         * @var ImporterModel[] $importers
         */
        $importers = [];

        foreach ($query->posts as $post) {
            $importer_model = $this->importer_manager->get_importer($post);
            if ('schedule' === $importer_model->getSetting('import_method') && false === $this->is_cron_disabled($importer_model)) {
                $importers[] = $importer_model;
            }
        }

        if (empty($importers)) {
            return $scheduled_importers;
        }

        foreach ($importers as $importer_model) {

            $importer_id = $importer_model->getId();

            $next_schedule = get_post_meta($importer_id, '_iwp_cron_scheduled', true);
            if (!$next_schedule) {

                $next_schedule = $this->spawn_importer($importer_model);
                if (!$next_schedule) {
                    continue;
                }

                update_post_meta($importer_id, '_iwp_cron_scheduled', $next_schedule);
                Logger::write('spawner -wp_schedule_event=' . date('Y-m-d H:i:s', $next_schedule), $importer_id);
            }

            if (!$next_schedule) {
                continue;
            }

            if (current_time('timestamp') >= $next_schedule) {
                $scheduled_importers[] = [
                    'time' => $next_schedule,
                    'importer' => $importer_model,
                    'last_ran' => (int)get_post_meta($importer_id, '_iwp_cron_last_ran', true)
                ];
            }
        }

        return $scheduled_importers;
    }

    public function unschedule($importer_id)
    {
        $importer_model = $this->importer_manager->get_importer($importer_id);

        $user = uniqid('iwp', true);

        ImporterState::wait_for_lock($importer_id, $user, function () use ($importer_id) {
            $state = ImporterState::get_state($importer_id);
            if (!$state) {
                return $state;
            }

            if ($state['status'] === 'running') {
                $state['status'] = 'cancelled';
            }

            ImporterState::set_state($importer_id, $state);
            do_action('iwp/importer/status/save', $state);

            return $state;
        });

        $this->cleanup($importer_model->getId());

        return true;
    }

    /**
     * Check to see if all schedules are disabled
     *
     * @param ImporterModel $importer_model
     * @return boolean
     */
    private function is_cron_disabled($importer_model)
    {
        $settings = $importer_model->getSetting('cron');
        if (!empty($settings)) {
            foreach ($settings as $setting) {
                if ($setting['setting_cron_disabled'] === false) {
                    return false;
                }
            }
        }

        return true;
    }

    public function calculate_scheduled_time($schedule, $day = 0, $hour = 0, $minute = 0, $current_time = null)
    {
        $minute_padded = str_pad($minute, 2, 0, STR_PAD_LEFT);
        $hour_padded = str_pad($hour, 2, 0, STR_PAD_LEFT);
        $day_padded = str_pad($day, 2, 0, STR_PAD_LEFT);
        $time_offset = time() - current_time('timestamp');
        $current_time = !is_null($current_time) ? $current_time : time();
        $scheduled_time = false;

        switch ($schedule) {
            case 'month':
                // 1-31

                // 31st of feb, should = 28/29
                if (date('t', $current_time) < $day) {
                    $day_padded = str_pad(date('t', $current_time), 2, 0, STR_PAD_LEFT);
                }

                $scheduled_time = $time_offset + strtotime(date('Y-m-' . $day_padded . ' ' . $hour_padded . ':' . $minute_padded . ':00', $current_time));

                if ($scheduled_time < $current_time) {

                    // 31st of feb, should = 28/29
                    $future_time = strtotime('+28 days', $current_time); // 28 days is the shortest month, adding + 1 month can skip feb
                    if (date('t', $future_time) < $day) {
                        $day_padded = str_pad(date('t', $future_time), 2, 0, STR_PAD_LEFT);
                    }

                    $scheduled_time = $time_offset + strtotime(date('Y-m-' . $day_padded . ' ' . $hour_padded . ':' . $minute_padded . ':00', $future_time));
                }
                break;
            case 'week':
                // day 0-6 : 0 = SUNDAY
                $day_str = '';
                switch (intval($day)) {
                    case 0:
                        $day_str =  'sunday';
                        break;
                    case 1:
                        $day_str =  'monday';
                        break;
                    case 2:
                        $day_str =  'tuesday';
                        break;
                    case 3:
                        $day_str =  'wednesday';
                        break;
                    case 4:
                        $day_str =  'thursday';
                        break;
                    case 5:
                        $day_str =  'friday';
                        break;
                    case 6:
                        $day_str =  'saturday';
                        break;
                }
                $scheduled_time = $time_offset + strtotime(date('Y-m-d ' . $hour_padded . ':' . $minute_padded . ':00', strtotime('next ' . $day_str, $current_time)));
                if ($scheduled_time - WEEK_IN_SECONDS > $current_time) {
                    $scheduled_time -= WEEK_IN_SECONDS;
                }
                break;
            case 'day':
                $scheduled_time = $time_offset + strtotime(date('Y-m-d ' . $hour_padded . ':' . $minute_padded . ':00', $current_time));
                if ($scheduled_time <= $current_time) {
                    $scheduled_time += DAY_IN_SECONDS;
                }
                break;
            case 'hour':
                $scheduled_time = strtotime(date('Y-m-d H:' . $minute_padded . ':00', $current_time));
                if ($scheduled_time <= $current_time) {
                    $scheduled_time += HOUR_IN_SECONDS;
                }
                break;
        }

        return $scheduled_time;
    }

    public function cleanup($importer_id)
    {
        delete_post_meta($importer_id, '_iwp_cron_scheduled');
    }

    /**
     * @param ImporterModel $importer_model
     */
    public function spawn_importer($importer_model)
    {
        $schedule_settings = $importer_model->getSetting('cron');
        if (empty($schedule_settings)) {
            return false;
        }

        $schedule_next = -1;

        foreach ($schedule_settings as $schedule_setting) {

            if (!isset($schedule_setting['setting_cron_schedule'], $schedule_setting['setting_cron_day'], $schedule_setting['setting_cron_minute'], $schedule_setting['setting_cron_schedule'], $schedule_setting['setting_cron_disabled'])) {
                continue;
            }

            $schedule = $schedule_setting['setting_cron_schedule'];
            $day = $schedule_setting['setting_cron_day'];
            $hour = $schedule_setting['setting_cron_hour'];
            $minute = $schedule_setting['setting_cron_minute'];
            $disabled = $schedule_setting['setting_cron_disabled'];

            if ($disabled === true) {
                continue;
            }

            $scheduled_time = $this->calculate_scheduled_time($schedule, $day, $hour, $minute);
            if (false === $scheduled_time) {
                continue;
            }

            if ($schedule_next === -1 || $schedule_next > $scheduled_time) {
                $schedule_next = $scheduled_time;
            }
        }

        if ($schedule_next === -1) {
            return false;
        }

        return $schedule_next;
    }

    /**
     * @param ImporterModel $importer_model 
     * @return string
     */
    public function get_status($importer_model)
    {
        $importer_model = $this->importer_manager->get_importer($importer_model);

        // start | stopped | running | error
        $importer_id = $importer_model->getId();
        $state = ImporterState::get_state($importer_id);
        $last_ran = (int)get_post_meta($importer_id, '_iwp_cron_last_ran', true);
        $scheduled_time = (int)get_post_meta($importer_id, '_iwp_cron_scheduled', true);

        if ($scheduled_time > $last_ran) {

            // waiting on schedule
            if ($scheduled_time) {
                // scheduled but not started
                return [
                    'status' => 'start',
                    'time' => $scheduled_time,
                    'delta' => $scheduled_time - time()
                ];
            }

            // not scheduled
            $spawner_time = wp_next_scheduled($this->_cron_main_handle);
            return [
                'status' => 'spawner',
                'time' => $spawner_time,
                'delta' => $spawner_time - time()
            ];
        }

        return [
            'status' => isset($state['status']) ? $state['status'] : '',
            'time' => $scheduled_time,
            'delta' => $scheduled_time - time()
        ];
    }

    /**
     * Modify the status message
     *
     * @param array $output
     * @param ImporterModel $importer_model
     * @return array
     */
    public function update_status_message($output, $importer_model)
    {

        $status = $this->get_status($importer_model);

        if ('schedule' !== $importer_model->getSetting('import_method') || false !== $this->is_cron_disabled($importer_model)) {
            return $output;
        }

        switch ($status['status']) {
            case 'start':
                $output['message'] = '(Scheduled at ' . date(get_site_option('date_format') . ' ' . get_site_option('time_format'), $status['time']) . ') ' . $output['message'];
                break;
            case 'spawner':
                $output['message'] = '(Scheduling) ' . $output['message'];
                break;
            case 'resume':
                $output['message'] = '(Resuming in ' . $status['delta'] . 's) ' . $output['message'];
                break;
        }

        $output['cron'] = $status;
        return $output;
    }
}
