<?php


namespace Cartsy_Lite\Framework\Admin;

use Cartsy_Lite\Framework\Admin\Traits\Cartsy_Lite_Admin_Script_Trait;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

if ( ! class_exists( 'Cartsy_Lite_Welcome' ) ) {
    
    class Cartsy_Lite_Welcome {
    
        use Cartsy_Lite_Admin_Script_Trait;

        public $theme_args = [];
    
        /**
         * Main constructor.
         */
        public function __construct() {
            $this->setup_config();
            add_action( 'init', [ $this, 'setup_config' ] );
            add_action( 'admin_menu', [ $this, 'register' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
            $this->tab_init();
        }

    
        /**
         * Setup the class props based on current theme.
         */
        public function setup_config() {
            $cartsy_lite_theme = wp_get_theme();
    
            $this->theme_args['name']        = apply_filters( 'cartsy_lite_theme_name', $cartsy_lite_theme->__get( 'Name' ) );
            $this->theme_args['template']    = $cartsy_lite_theme->get( 'Template' );
            $this->theme_args['version']     = $cartsy_lite_theme->__get( 'Version' );
            $this->theme_args['description'] = apply_filters( 'cartsy_lite_theme_description', $cartsy_lite_theme->__get( 'Description' ) );
            $this->theme_args['slug']        = $cartsy_lite_theme->__get( 'stylesheet' );
        }
    
    
        /**
         * Register theme options page.
         *
         * @return void
         */
        public function register() {
            $cartsy_lite_theme = $this->theme_args;
    
            if ( empty( $cartsy_lite_theme['name'] ) || empty( $cartsy_lite_theme['slug'] ) ) {
                return;
            }
    
            /* translators: %s - Theme name */
            $cartsy_lite_page_title = sprintf( __( '%s Tour', 'cartsy-lite' ), wp_kses_post( $cartsy_lite_theme['name'] ) );
            /* translators: %s - Theme name */
            $cartsy_lite_menu_name = sprintf( __( '%s Tour', 'cartsy-lite' ), wp_kses_post( $cartsy_lite_theme['name'] ) );
    
            $cartsy_lite_theme_page = ! empty( $cartsy_lite_theme['template'] ) ? $cartsy_lite_theme['template'] . '-welcome' : $cartsy_lite_theme['slug'] . '-welcome';
            
            add_theme_page( 
                $cartsy_lite_page_title, 
                $cartsy_lite_menu_name, 
                'activate_plugins', 
                $cartsy_lite_theme_page, 
                [ $this , 'render' ] 
            );
        }

        /**
         * enqueue
         *
         * @return void
         */
        public function enqueue()
        {
            $screen = get_current_screen();
            if ( ! isset( $screen->id ) ) {
                return;
            }

            $theme      = $this->theme_args;
            $dashboard_page = ! empty( $theme['template'] ) ? $theme['template'] . '-welcome' : $theme['slug'] . '-welcome';

            if ( $screen->id !== 'appearance_page_' . $dashboard_page ) {
                return;
            }

            self::Dashboard_Enqueue_Style();
            self::Dashboard_Enqueue_Script();
        }
    
        /**
         * Application stub items.
         *
         * @return array()
         */
        public function tab_items()
        {
            return [
                'Getting_Started',
                'Free_Vs_Premium',
                'Changelog',
            ];
        }

        /**
         * Remove special char.
         *
         * @return string
         */
        public function removeSpecialCharAndSpace( $value )
        {
            $stripped = trim(preg_replace('/\_/', ' ', $value));

            return $stripped;
        }

        /**
         * Remove special char and make class
         *
         * @return string
         */
        public function make_className($value) 
        {
            $class_name = ucfirst($value) . '_Content';
    
            return $class_name;
        }

        /**
         * Render the application navigation items.
         *
         * @return void
         */
        public function tab_navigation_items()
        {
            $tab_items = $this->tab_items();
            if (empty($tab_items) && !is_array($tab_items)) {
                return;
            }

            $cartsy_lite_theme = $this->theme_args;

            //Get the active tab from the $_GET param
            $tab = wp_unslash(isset($_GET['tab'])) ? wp_unslash($_GET['tab']) : null;
            $stripped_tab = strtolower($tab);

            $cartsy_lite_theme_page = ! empty( $cartsy_lite_theme['template'] ) ? $cartsy_lite_theme['template'] . '-welcome' : $cartsy_lite_theme['slug'] . '-welcome';

            ?>
            <nav class="redq-admin-dashboard-tab-wrapper">
                <?php 
                    $index = 0;
                    foreach ($tab_items as $key => $value) {
                        $index++;

                        $stripped = strtolower($value);

                        ?>

                        <a href="?page=<?php echo esc_attr($cartsy_lite_theme_page . "&tab=" . $stripped); ?>" class="redq-admin-dashboard-tab <?php echo esc_attr( $tab === null && $index === 1 ? " redq-admin-dashboard-tab-active" : "" ); echo esc_attr( $stripped_tab === $stripped ? " redq-admin-dashboard-tab-active" : "" ); ?>">
                            <?php echo esc_html( $this->removeSpecialCharAndSpace($value), 'cartsy-lite' ) ?>
                        </a>

                        <?php
                    }
                ?>
                <a href="<?php echo esc_url("https://redq.io/cartsy") ?>" rel="external noreferrer noopener" class="redq-admin-button" target="_blank"><?php echo esc_html__("Get Cartsy Pro", "cartsy-lite"); ?></a>
            </nav>
            <?php
        }

        /**
         * Render the application navigation content.
         *
         * @return void
         */
        public function tab_content()
        {
            $tab_items = $this->tab_items();
            if (empty($tab_items) && !is_array($tab_items)) {
                return;
            }

            $tab = isset($_GET['tab']) ? $_GET['tab'] : null;
            $stripped_tab = strtolower($tab);

            ?>
            <div class="redq-admin-tab-content">
                <?php 
                if ($tab) {
                    foreach ($tab_items as $key => $value) {
                        $stripped = strtolower($value);

                        if ($stripped_tab === $stripped) {
                            $file = __DIR__ . '/Welcome' . '/' . $value . ".php";

                            $class_name = '\Cartsy_Lite\Framework\Admin\Welcome\\' . $this->make_className($value);

                            if (file_exists($file)) {
                                get_template_part($file);
                                if (class_exists($class_name)) {
                                    new $class_name($this->theme_args);
                                }
                            }
                        }
                    }
                } else {
                    if (isset($tab_items[0])) {
                        $file = __DIR__ . '/Welcome//' . $tab_items[0] . '.php';
    
                        $class_name = '\Cartsy_Lite\Framework\Admin\Welcome\\' . $tab_items[0] . '_Content';
    
                        if (file_exists($file)) {
                            get_template_part($file);
                            if (class_exists($class_name)) {
                                new $class_name($this->theme_args);
                            }
                        }
                    }
                }
                ?>
            </div>
            <?php
        }

        /**
         * Render the application tab init.
         *
         * @return void
         */
        public function tab_init()
        {
            add_action( 'redq_backend_tab_items', [$this, 'tab_navigation_items'] );
            add_action( 'redq_backend_tab_content', [$this, 'tab_content'] );
        }


        /**
         * Render the application stub.
         *
         * @return void
         */
        public function render() {
            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }
            $cartsy_lite_theme = $this->theme_args;

            $cartsy_lite_theme_page = ! empty( $cartsy_lite_theme['template'] ) ? $cartsy_lite_theme['template'] . '-welcome' : $cartsy_lite_theme['slug'] . '-welcome';
            ?>
            <div class="redq-admin-dashboard <?php echo esc_attr( $cartsy_lite_theme['name'] ); ?>-admin-dashboard">
                <!-- Our admin page content should all be inside .wrap -->
                <div class="redq-dashboard-wrap">
                    <div class="redq-dashboard-header">
                        <div class="container">
                            <!-- Print the page title -->
                            <div class="redq-dashboard-header-top">
                                <div class="redq-dashboard-header-top-left">
                                    <h1 class="redq-dashboard-header-title">
                                        <span class="title"><?php echo esc_html( $cartsy_lite_theme['name'] ); ?></span>
                                    </h1>
                                </div>
                                <div class="redq-dashboard-header-top-right">
                                    <div class="redq-dashboard-header-top-content">
                                        <a href="<?php echo esc_url("https://wordpress.org/themes/cartsy-lite/") ?>" rel="external noreferrer noopener" target="_blank" class="redq-dashboard-header-top-content-link">
                                            <img src="<?php echo esc_url(CARTSY_LITE_IMAGE_PATH . 'logo.svg'); ?>" alt="<?php echo esc_attr( $cartsy_lite_theme['name'] ); ?>">
                                            <span class="title"><?php echo esc_html( $cartsy_lite_theme['name'] ); ?></span>
                                            <span class="version"><?php echo esc_html__('v', 'cartsy-lite'); ?> <?php echo esc_html( $cartsy_lite_theme['version'] ); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Here are our tabs link -->
                            <?php 
                                /**
                                 * Functions hooked into redq_backend_tab_items action
                                 */
                                do_action( "redq_backend_tab_items" ); 
                            ?>
                        </div>
                    </div>
                    <div class="redq-dashboard-sticky-header redq-dashboard-header">
                        <div class="container">
                            <?php 
                                /**
                                 * Functions hooked into redq_backend_tab_items action
                                 */
                                do_action( "redq_backend_tab_items" ); 
                            ?>
                        </div>
                    </div>
                    <!-- Here are our tabs -->
                    <div class="container">
                        <?php 
                            
                            /**
                             * Functions hooked into redq_backend_tab_content action
                             */
                             do_action( "redq_backend_tab_content" ); 
                        ?>
                    </div>    
                </div>    
            </div>
            <?php
        }
    }

}
