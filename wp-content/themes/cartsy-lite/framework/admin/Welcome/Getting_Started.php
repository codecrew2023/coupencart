<?php

namespace Cartsy_Lite\Framework\Admin\Welcome;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}


if ( ! class_exists( 'Getting_Started_Content' ) ) {

    class Getting_Started_Content 
    {

        public function __construct($config = []) {
            $this->Init($config);
        }

        /**
         * Get the Customize Shortcut Links.
         *
         * @return array
         */
        private function get_customize_shortcuts() {
            return [
                [
                    'text' => __( 'Upload Logo', 'cartsy-lite' ),
                    'link' => add_query_arg( [ 'autofocus[control]' => 'custom_logo' ], admin_url( 'customize.php' ) ),
                ],
                [
                    'text' => __( 'Set Colors', 'cartsy-lite' ),
                    'link' => add_query_arg( [ 'autofocus[section]' => 'cartsy_lite_color_section' ], admin_url( 'customize.php' ) ),
                ],
                [
                    'text' => __( 'Customize Fonts', 'cartsy-lite' ),
                    'link' => add_query_arg( [ 'autofocus[section]' => 'cartsy_lite_typography_section' ], admin_url( 'customize.php' ) ),
                ],
                [
                    'text' => __( 'Layout Options', 'cartsy-lite' ),
                    'link' => add_query_arg( [ 'autofocus[section]' => 'cartsy_lite_general_section' ], admin_url( 'customize.php' ) ),
                ],
                [
                    'text' => __( 'Header Options', 'cartsy-lite' ),
                    'link' => add_query_arg( [ 'autofocus[section]' => 'cartsy_lite_header_section' ], admin_url( 'customize.php' ) ),
                ],
                [
                    'text' => __( 'Blog Layouts', 'cartsy-lite' ),
                    'link' => add_query_arg( [ 'autofocus[section]' => 'cartsy_lite_blog_section' ], admin_url( 'customize.php' ) ),
                ],
                [
                    'text' => __( 'Footer Options', 'cartsy-lite' ),
                    'link' => add_query_arg( [ 'autofocus[section]' => 'cartsy_lite_footer_section' ], admin_url( 'customize.php' ) ),
                ],
                [
                    'text' => __( 'WooCommerce', 'cartsy-lite' ),
                    'link' => add_query_arg( [ 'autofocus[section]' => 'cartsy_lite_woo_section' ], admin_url( 'customize.php' ) ),
                ],
            ];
        }

        /**
         * Get the Documentation Links.
         *
         * @return array
         */
        private function get_documentation_shortcuts() {
            return [
                [
                    'text' => esc_html__( 'Go to Cartsy Lite docs', 'cartsy-lite' ),
                    'link' => esc_url( "https://cartsy-lite-doc.vercel.app/" ),
                ],
            ];
        }
        
        /**
         * Starter blocks
         *
         * @return void
         */
        public function StarterBlock($config = [])
        {
            ?>
            <div class="redq-admin-dashboard-grid-item">
                <div class="redq-admin-starter-block">
                    <div class="redq-admin-box-heading">
                        <span class="dashicons dashicons-layout"></span>
                        <h2><?php echo esc_html__( "Welcome", 'cartsy-lite' ) ?></h2>
                    </div>
                    <div class="redq-admin-box-content">
                        <p><?php echo wp_kses_post( $config['description'] ); ?></p>
                        <div class="redq-admin-button-group">
                            <a href="<?php echo esc_url( "https://wordpress.org/themes/cartsy-lite/" ) ?>" target="_blank" class="redq-admin-button"><?php echo esc_html__( "Go to starter site", "cartsy-lite" ) ?></a>
                            <a href="<?php echo esc_url( "https://redq.io/cartsy" ) ?>" target="_blank" class="redq-admin-button"><?php echo esc_html__( "Get Cartsy Pro", "cartsy-lite" )?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        /**
         * Customize blocks
         *
         * @return void
         */
        public function CustomizeBlock($config = [])
        {
            $get_customize_shortcuts = $this->get_customize_shortcuts();
            ?>
            <div class="redq-admin-dashboard-grid-item">
                <div class="redq-admin-starter-block">
                    <div class="redq-admin-box-heading">
                        <span class="dashicons dashicons-admin-links"></span>
                        <h2><?php echo esc_html__( "Customize Links", 'cartsy-lite' ) ?></h2>
                    </div>
                    <div class="redq-admin-box-content">
                        <div class="redq-admin-grid-group">
                            <?php if (!empty($get_customize_shortcuts) && is_array($get_customize_shortcuts)) {
                            foreach ($get_customize_shortcuts as $key => $value) { ?>
                            <a href="<?php echo esc_url( $value['link'] ); ?>" target="_blank" class="redq-admin-link">
                                <span class="dashicons dashicons-external"></span>
                                <?php echo esc_html( $value['text'] ) ?>
                            </a>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        /**
         * Documentation blocks
         *
         * @return void
         */
        public function DocumentationBlock($config = [])
        {
            $get_doc_shortcuts = $this->get_documentation_shortcuts();
            ?>
            <div class="redq-admin-dashboard-grid-item">
                <div class="redq-admin-starter-block">
                    <div class="redq-admin-box-heading">
                        <span class="dashicons dashicons-media-text"></span>
                        <h2><?php echo esc_html__( "Documentation", 'cartsy-lite' ) ?></h2>
                    </div>
                    <div class="redq-admin-box-content">
                        <p><?php echo esc_html__( "Our rich documentation, FAQ, video tutorials will help you to understand each and every aspects of our theme. We have a proper installation guide and videos so that you can start your making your websites easily. By our change-log option, you will able to track our regular updates.", "cartsy-lite" ); ?></p>
                        <?php if (!empty($get_doc_shortcuts) && is_array($get_doc_shortcuts)) { ?>
                        <div class="redq-admin-button-group">
                        <?php foreach ($get_doc_shortcuts as $key => $value) { ?>
                            <div class="redq-admin-button-item">
                                <a href="<?php echo esc_url( $value['link'] ); ?>" target="_blank" class="redq-admin-link">
                                    <span class="dashicons dashicons-external"></span>
                                    <?php echo wp_kses_post( $value['text'] ); ?>
                                </a>
                            </div>
                        <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }

        /**
         * Starter blocks
         *
         * @return void
         */
        public function SupportBlock($config = [])
        {
            ?>
            <div class="redq-admin-dashboard-grid-item">
                <div class="redq-admin-starter-block">
                    <div class="redq-admin-box-heading">
                        <span class="dashicons dashicons-format-status"></span>
                        <h2><?php echo esc_html__( "Support", 'cartsy-lite' ) ?></h2>
                    </div>
                    <div class="redq-admin-box-content">
                        <p><?php echo esc_html__( "Customer is our main priority. We can assure you the proper Elite Author support and faster response for our theme. We have a dedicated support team with perfect technical knowledge to provide the correct solutions of your problem as early as possible. ", "cartsy-lite" ); ?></p>
                        <div class="redq-admin-button-group">
                            <div class="redq-admin-button-item">
                                <a href="<?php echo esc_url( "https://wordpress.org/support/theme/cartsy-lite/" ); ?>"  target="_blank" class="redq-admin-link">
                                    <span class="dashicons dashicons-external"></span>
                                    <?php echo esc_html__( "Contact Support", "cartsy-lite" ) ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        /**
         * Init
         *
         * @return void
         */
        public function Init($config = [])
        {
            ?>
            <div class="redq-admin-dashboard-grid">
                <?php 
                    $this->StarterBlock($config);
                    $this->DocumentationBlock($config);
                    $this->CustomizeBlock($config);
                    $this->SupportBlock($config);
                ?>
            </div>
            <?php
        }
    }

}