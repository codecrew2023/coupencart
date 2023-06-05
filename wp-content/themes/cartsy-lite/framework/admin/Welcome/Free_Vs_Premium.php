<?php

namespace Cartsy_Lite\Framework\Admin\Welcome;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

if ( ! class_exists( 'Free_Vs_Premium_Content' ) ) {
    class Free_Vs_Premium_Content {

        public function __construct() {
            $this->Content();
        }

        /**
         * Get the Documentation Links.
         *
         * @return array
         */
        private function get_documentation_shortcuts() {
            return [
                [
                    'title'       => esc_html__( 'Lifetime Usage','cartsy-lite' ),
                    'description' => esc_html__( 'Once you download the theme, you are authorised to play with the themes lifetime.','cartsy-lite' ),
                    'lite'        => true,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://redq.io/landing/cartsy' ),
                ],
                [
                    'title'       => esc_html__( 'lifetime updates','cartsy-lite' ),
                    'description' => esc_html__( 'Cartsy theme will be updated regularly with different integrations, demos and features.','cartsy-lite' ),
                    'lite'        => true,
                    'pro'         => false,
                    'docs_link'   => esc_url( 'https://redq.io/cartsy#pricing' ),
                ],
                [
                    'title'       => esc_html__( 'Tested with latest WooCommerce','cartsy-lite' ),
                    'description' => esc_html__( 'Cartsy theme is always updated with the latest version of WooCommerce','cartsy-lite' ),
                    'lite'        => true,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-lite-doc.vercel.app/changelog' ),
                ],
                [
                    'title'       => esc_html__( 'Tested with latest WordPress','cartsy-lite' ),
                    'description' => esc_html__( 'Cartsy theme is always updated with the latest version of Wordpress.','cartsy-lite' ),
                    'lite'        => true,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-lite-doc.vercel.app/changelog' ),
                ],
                [
                    'title'       => esc_html__( 'One click installation','cartsy-lite' ),
                    'description' => esc_html__( 'Import your demo content, widgets and theme settings with one click. Import, customize and set up our super fast & flexible import tool. It\'s that easy.','cartsy-lite' ),
                    'lite'        => false,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-doc.vercel.app/demo-import' ),
                ],
                [
                    'title'       => esc_html__( 'RNB plugin included','cartsy-lite' ),
                    'description' => esc_html__( 'On Cartsy, we have provided support for one of our best selling rental plugin RnB - WooCommerce Booking & Rental Plugin. With Cartsy and RnB, you can build and sell your rental items.','cartsy-lite' ),
                    'lite'        => false,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-doc.vercel.app/cartsy-rental-feature' ),
                ],
                [
                    'title'       => esc_html__( 'FireMobile plugin included','cartsy-lite' ),
                    'description' => esc_html__( 'Allow users to login/register simply with their mobile number by our Firbase Mobile OTP Authentication Plugin. No more password or email required. Keep track of your customer using their mobile number.','cartsy-lite' ),
                    'lite'        => false,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-doc.vercel.app/firemobile' ),
                ],
                [
                    'title'       => esc_html__( 'Algolia integration','cartsy-lite' ),
                    'description' => esc_html__( 'Our E-Commerce theme is equipped with product search and filters to find what you want. Feel the magic of search with Algolia with both free & premium model. You can use algolia free for upto 10,000 search requests.','cartsy-lite' ),
                    'lite'        => false,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-doc.vercel.app/cartsy-algolia' ),
                ],
                [
                    'title'       => esc_html__( 'Social login','cartsy-lite' ),
                    'description' => esc_html__( 'The Cartsy social login feature allows users a hassle free registration/login option to your site using their social network accounts.','cartsy-lite' ),
                    'lite'        => false,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-doc.vercel.app/social-login' ),
                ],
                [
                    'title'       => esc_html__( 'Ticket based priority support','cartsy-lite' ),
                    'description' => esc_html__( "Customer is our main priority. We can assure you the proper Elite Author support and faster response for our theme.",'cartsy-lite' ),
                    'lite'        => false,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-doc.vercel.app/' ),
                ],
                [
                    'title'       => esc_html__( 'Multiple header & Footer','cartsy-lite' ),
                    'description' => esc_html__( "Play with different cartsy header & footer option. We have implemented multiple headers and footers layout so that you can customize your website based on your requirements.",'cartsy-lite' ),
                    'lite'        => false,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-doc.vercel.app/header-setting' ),
                ],
                [
                    'title'       => esc_html__( 'Multiple Layout Options','cartsy-lite' ),
                    'description' => esc_html__( 'Cartsy has multiple home page and product single page layouts. User can easily choose home page layout from Cartsy layouts window. For product single page there are options in the Kirki customize panel.','cartsy-lite' ),
                    'lite'        => false,
                    'pro'         => true,
                    'docs_link'   => esc_url( 'https://cartsy-doc.vercel.app/cartsy-layout' ),
                ],
            ];
        }

        /**
         * Render content
         *
         * @return void
         */
        public function Content()
        {
            $contents = $this->get_documentation_shortcuts();
            if (empty($contents) && !is_array($contents)) {
                return;
            }
            ?>
            <table class="redq-admin-dashboard-table">
                <thead class="redq-admin-dashboard-table-head">
                    <tr>
                        <th scope="col"><?php echo esc_html__('Free vs Premium', 'cartsy-lite'); ?></th>
                        <th scope="col"><?php echo esc_html__('Free', 'cartsy-lite'); ?></th>
                        <th scope="col"><?php echo esc_html__('Premium', 'cartsy-lite'); ?></th>
                    </tr>
                </thead>
                <tbody class="redq-admin-dashboard-table-body">
                    <?php foreach ($contents as $key => $value) { ?>
                        <tr>
                            <td>
                                <div class="redq-admin-dashboard-table-content">
                                    <?php if (isset($value['title']) && !empty($value['title'])) { ?>
                                    
                                        <span class="title"><?php echo wp_kses_post( $value['title'] ) ?></span>
                                    
                                    <?php } ?>

                                    <?php if (isset($value['description']) && !empty($value['description'])) { ?>
                                    <div class="redq-description-wrap">
                                        <span class="dashicons dashicons-editor-help redq-tooltip-point"></span>
                                        <div class="redq-description">
                                            <div class="redq-description-content">
                                                <?php echo wp_kses_post( $value['description'] ) ?>

                                                <?php if (isset($value['docs_link']) && !empty($value['docs_link'])) { ?>

                                                    <?php echo esc_html__( "More details ", "cartsy-lite" ) ?><a href="<?php echo esc_url( $value['docs_link'] ); ?>" target="blank"><?php echo esc_html__( "docs", "cartsy-lite" ) ?></a>

                                                <?php } ?>
                                            </div>
                                            <div class="redq-tooltip-arrow"></div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <div class="redq-free-pro-indicator">
                                    <?php if (isset($value['lite'])) { ?>

                                        <?php if ($value['lite']) { ?>
                                            <span class="dashicons dashicons-yes-alt"></span>
                                        <?php } else { ?>
                                            <span class="dashicons dashicons-dismiss redq-dismiss"></span>
                                        <?php }  ?>

                                    <?php }  ?>
                                </div>
                            </td>
                            <td>
                                <div class="redq-free-pro-indicator">
                                    <?php if (isset($value['pro'])) { ?>

                                        <?php if ($value['pro']) { ?>
                                            <span class="dashicons dashicons-yes-alt"></span>
                                        <?php } else { ?>
                                            <span class="dashicons dashicons-dismiss redq-dismiss"></span>
                                        <?php } ?>

                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
        }
    }
}