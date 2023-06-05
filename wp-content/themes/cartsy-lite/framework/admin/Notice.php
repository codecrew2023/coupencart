<?php


namespace Cartsy_Lite\Framework\Admin;

use Cartsy_Lite\Framework\Admin\Traits\Cartsy_Lite_Admin_Script_Trait;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

if (!class_exists('Cartsy_Lite_Welcome_Admin_Notice')) {

    class Cartsy_Lite_Welcome_Admin_Notice
    {

        use Cartsy_Lite_Admin_Script_Trait;

        public $theme_args = [];

        public function __construct()
        {
            $this->setup_config();
            add_action('init', [$this, 'setup_config']);
            add_action('admin_notices', [$this, 'redq_admin_notice'], 1);

            add_action('admin_enqueue_scripts', [$this, 'enqueue'], 5);

            // Reset notice
            add_action('switch_theme', [$this, 'redq_reset_notices']);
            add_action('after_switch_theme', [$this, 'redq_reset_notices']);

            // Dismiss Notice
            add_action('wp_ajax_redq_dismissed_handler', [$this, 'redq_notice_dismissed_handler']);
            add_action('admin_enqueue_scripts', [$this, 'redq_notice_enqueue_scripts'], 5);
        }

        /**
         * Setup the class props based on current theme.
         */
        public function setup_config()
        {
            $cartsy_lite_theme = wp_get_theme();

            $this->theme_args['name']        = apply_filters('cartsy_lite_theme_name', $cartsy_lite_theme->__get('Name'));
            $this->theme_args['template']    = $cartsy_lite_theme->get('Template');
            $this->theme_args['version']     = $cartsy_lite_theme->__get('Version');
            $this->theme_args['description'] = apply_filters('cartsy_lite_theme_description', $cartsy_lite_theme->__get('Description'));
            $this->theme_args['slug']        = $cartsy_lite_theme->__get('stylesheet');
            $this->theme_args['screen_short']        = $cartsy_lite_theme->get_screenshot();
        }

        /**
         * render admin notice content
         *
         * @return void
         */
        public function redq_admin_notice()
        {
            $screen = get_current_screen();
            if ($screen->id !== 'themes') {
                return;
            }

            if (defined('DOING_AJAX') && DOING_AJAX) {
                return;
            }

            if (is_network_admin()) {
                return;
            }

            if (!current_user_can('manage_options')) {
                return;
            }

            $cartsy_lite_theme = $this->theme_args;
            $transient_name = 'cartsy_lite_activation_notice';

            if (!get_transient($transient_name)) {

                $redq_notice_contents = $this->redq_notice_array();
?>
                <div class="redq-admin-notice notice notice-success is-dismissible" data-redq-notice="<?php echo esc_attr($transient_name); ?>">

                    <button type="button" class="notice-dismiss"></button>

                    <div class="redq-admin-notice-panel">
                        <div class="redq-admin-notice-panel-left">
                            <div class="redq-dashboard-notice-head">
                                <h2 class="redq-dashboard-notice-head-title"><?php echo esc_html__('Congratulations', 'cartsy-lite'); ?></h2>
                                <p class="redq-dashboard-notice-head-content">
                                    <?php echo esc_html($cartsy_lite_theme['name']) . esc_html__(' is now installed and ready to use.', 'cartsy-lite'); ?>
                                </p>
                            </div>

                            <?php if (!empty($redq_notice_contents) && is_array($redq_notice_contents)) { ?>
                                <div class="redq-admin-notice-grid">

                                    <?php foreach ($redq_notice_contents as $key => $notice) { ?>

                                        <div class="redq-admin-notice-grid-item">

                                            <?php if (isset($notice['icon']) || isset($notice['title'])) { ?>
                                                <div class="redq-admin-notice-grid-item-head">
                                                    <?php if (isset($notice['icon'])) { ?>
                                                        <span class="<?php echo esc_attr($notice['icon']) ?> redq-admin-notice-grid-item-head-icon"></span>
                                                    <?php } ?>

                                                    <?php if (isset($notice['title'])) { ?>
                                                        <h2 class="redq-admin-notice-grid-item-head-title"><?php echo wp_kses_post($notice['title']) ?></h2>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if (isset($notice['content']) || isset($notice['button'])) { ?>
                                                <div class="redq-admin-notice-grid-item-content">
                                                    <?php if (isset($notice['content'])) { ?>
                                                        <p><?php echo wp_kses_post($notice['content']); ?></p>
                                                    <?php } ?>

                                                    <?php if (isset($notice['button'])) { ?>
                                                        <a href="<?php echo esc_url($notice['button']['link']) ?>" target="_blank" class="redq-admin-link">
                                                            <span class="dashicons dashicons-external"></span>
                                                            <?php echo esc_html($notice['button']['text']) ?>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    <?php } ?>

                                </div>
                            <?php } ?>
                        </div>

                        <div class="redq-admin-notice-panel-right">
                            <img class="redq-admin-notice-panel-sc" src="<?php echo esc_url($cartsy_lite_theme['screen_short']); ?>" alt="<?php echo esc_attr($cartsy_lite_theme['name']) ?>" />
                        </div>
                    </div>

                </div>
            <?Php
            }
        }

        /**
         * Get the notice content.
         *
         * @return array
         */
        public function redq_notice_array()
        {
            $cartsy_lite_theme = $this->theme_args;

            return [
                [
                    'title'   => "Welcome",
                    'icon'    => "dashicons dashicons-format-aside",
                    'content' => $cartsy_lite_theme['description'],
                    'button'  => [
                        'text' => "Go to the theme settings",
                        'link' => class_exists('Kirki') ? add_query_arg(['autofocus[panel]' => 'cartsy_lite_config_panel'], admin_url('customize.php')) : add_query_arg(['autofocus[control]' => 'custom_logo'], admin_url('customize.php')),
                    ]
                ],
                [
                    'title'   => "Documentation",
                    'icon'    => "dashicons dashicons-format-aside",
                    'content' => "Our rich documentation, FAQ, video tutorials will help you to understand each and every aspects of our theme. We have a proper installation guide and videos so that you can start your making your websites easily. By our change-log option, you will able to track our regular updates.",
                    'button'  => [
                        'text' => "Read full documentation",
                        'link' => 'https://cartsy-lite-doc.vercel.app/'
                    ]
                ],
            ];
        }

        /**
         * Reset Notice.
         */
        public function redq_reset_notices()
        {
            $transient_name = 'cartsy_lite_activation_notice';
            delete_transient($transient_name);
        }

        /**
         * Dismissed handler
         */
        public function redq_notice_dismissed_handler()
        {
            wp_verify_nonce(null);

            if (isset($_POST['notice'])) {
                set_transient(sanitize_text_field(wp_unslash($_POST['notice'])), true, 0);
            }
        }

        /**
         * Notice Enqueue Scripts
         */
        public function redq_notice_enqueue_scripts($page)
        {

            wp_enqueue_script('jquery');

            ob_start();
            ?>
            <script>
                jQuery(function($) {
                    $(document).on('click', '.redq-admin-notice .notice-dismiss', function() {
                        jQuery.post('ajax_url', {
                            action: 'redq_dismissed_handler',
                            notice: $(this).parents('.redq-admin-notice').attr('data-redq-notice'),
                        });
                        $('.redq-admin-notice').hide();
                    });
                });
            </script>
<?php
            $script = str_replace('ajax_url', admin_url('admin-ajax.php'), ob_get_clean());

            wp_add_inline_script('jquery', str_replace(['<script>', '</script>'], '', $script));
        }

        /**
         * enqueue
         *
         * @return void
         */
        public function enqueue()
        {
            $screen = get_current_screen();
            if ($screen->id !== 'themes') {
                return;
            }

            self::Dashboard_Enqueue_Style();
        }
    }
}
