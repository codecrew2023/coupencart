<?php

namespace ImportWP\Pro;

use ImportWP\Common\Exporter\ExporterManager;
use ImportWP\Common\Plugin\Menu;
use ImportWP\Pro\Cron\CronManager;
use ImportWP\Pro\Importer\ImporterManager;
use ImportWP\Pro\Rest\RestManager;

class ServiceProvider extends \ImportWP\ServiceProvider
{
    /**
     * @var CronManager
     */
    public $cron_manager;

    /**
     * @var RestManager
     */
    public $rest_manager;

    /**
     * @var Menu
     */
    public $menu;

    /**
     * @var ImporterManager
     */
    public $importer_manager;

    public function __construct($event_handler)
    {
        parent::__construct($event_handler);

        $this->properties->is_pro = true;
        $this->properties->plugin_pro_file_path = realpath(dirname(__DIR__) . '/../importwp-pro.php');
        $this->properties->plugin_pro_dir_path = plugin_dir_path($this->properties->plugin_pro_file_path);
        $this->properties->plugin_pro_folder_name = basename($this->properties->plugin_pro_dir_path);
        $this->properties->plugin_pro_basename = plugin_basename($this->properties->plugin_pro_file_path);

        $this->importer_manager = new ImporterManager($this->filesystem, $this->template_manager, $event_handler);
        $this->exporter_manager = new ExporterManager();
        $this->menu = new Menu($this->properties, $this->view_manager, $this->importer_manager, $this->template_manager);

        $this->cron_manager = new CronManager($this->importer_manager, $event_handler);
        $this->rest_manager = new RestManager($this->importer_manager, $this->exporter_manager, $this->properties, $this->http, $this->filesystem, $this->template_manager, $this->cron_manager, $event_handler);

        add_action('load-tools_page_importwp', array($this, 'load_assets'));

        do_action('iwp/register_events', $event_handler, $this);
    }

    public function load_assets()
    {
        wp_enqueue_script($this->properties->plugin_domain . '-pro-bundle', plugin_dir_url($this->properties->plugin_pro_file_path) . 'dist/pro/js/bundle.js', array('importwp-bundle'), $this->properties->plugin_version, 'all');
        wp_enqueue_style($this->properties->plugin_domain . '-pro-bundle-styles', plugin_dir_url($this->properties->plugin_pro_file_path) . 'dist/pro/css/style.bundle.css', array('importwp-bundle-styles'), $this->properties->plugin_version, 'all');
    }
}
