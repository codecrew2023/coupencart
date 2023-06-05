<?php

namespace Cartsy_Lite\Framework\Admin\Welcome;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

if ( ! class_exists( 'Changelog_Content' ) ) {
    class Changelog_Content {

        public function __construct($config = []) 
        {
            $this->Content();
        }

        public function log_data()
        {
            $file = __DIR__ . '/changelog-array.php';
            if (file_exists($file)) {
                include $file;
                return $change_log_array;
            }
        }

        public function Content ()
        {
            ?>
            <div class="redq-admin-dashboard-log">
                <div class="redq-admin-dashboard-log-left">
                    <?php 
                        $this->LogHeader(); 
                        $this->LogContent(); 
                    ?>
                </div>
                <div class="redq-admin-dashboard-log-right">
                    <?php 
                        $this->LogSidebar();
                    ?>
                </div>
            </div>
            <?php
        }

        public function LogHeader()
        {
            $logs = $this->log_data();
            ?>
            <div class="redq-admin-dashboard-log-header">
                <h2 class="redq-admin-dashboard-log-header-title"><?php echo esc_html__( "Changelog", "cartsy-lite" ); ?></h2>
                
                <?php if (!empty($logs) && is_array($logs)) { 
                    $first_array_key = array_keys($logs)[0];
                    if (array_key_exists($first_array_key, $logs)) { ?>
                    <p class="redq-admin-dashboard-log-header-content">
                        <?php echo esc_html__( 'Last updated: ', "cartsy-lite" ) ?>
                        <?php 
                        if (isset($logs[$first_array_key]['release_date'])) {
                            echo esc_html( $logs[$first_array_key]['release_date'] );
                        } ?>
                    </p>
                <?php } } ?>
            </div>
            <?php
        }

        public function LogContent($config = [])
        {
            $logs = $this->log_data();
            if (empty($logs) && !is_array($logs)) {
                return;
            }
            ?>
            <div class="redq-dashboard-changelog">
                <?php foreach ($logs as $key => $log) { ?>
                <div class="redq-dashboard-changelog-wrap <?php echo esc_attr( 'redq-dashboard-changelog-v-' . $key )?>" id="<?php echo esc_attr( 'redq-dashboard-changelog-v-' . $key )?>">
                    
                    <?php if (isset($log['version']) && !empty($log['version'])) { ?>
                        <!-- Version -->
                        <h2 class="redq-dashboard-changelog-title"><?php echo esc_html__('Version ', 'cartsy-lite') . wp_kses_post($log['version']); ?></h2>

                    <?php } ?>

                    <?php if (isset($log['release_date']) && !empty($log['release_date'])) { ?>
                        <!-- Release date -->
                        <p class="redq-dashboard-changelog-release-date"><?php echo esc_html__('Released on  ', 'cartsy-lite') . wp_kses_post( $log['release_date'] ); ?></p>

                    <?php } ?>

                    <?php if (isset($log['logs']) && !empty($log['logs']) && is_array($log['logs'])) { ?>
                        <ul class="redq-dashboard-changelog-items">
                        
                        <?php foreach ($log['logs'] as $key => $items) { ?>

                        <li class="redq-dashboard-changelog-item redq-dashboard-changelog-item-<?php echo esc_attr( $key ) ?>">
                            <?php 
                                if (!empty($items) && is_array($items)) {
                                    foreach ($items as $item) { ?>
                                    
                                    <div class="redq-dashboard-changelog-item-title">
                                        <span class="dashicons dashicons-arrow-right-alt redq-dashboard-changelog-item-title-icon"></span>
                                        
                                        <div class="redq-dashboard-changelog-item-title-content">
                                            <span class="redq-dashboard-changelog-key">
                                                [<?php echo esc_html( $key ) ?>]
                                            </span>
                                            
                                            <?php echo esc_html( $item ) ?>
                                        </div>
                                    </div>
                                    
                                <?php 
                                    }
                                } 
                            ?>  
                        </li>

                        <?php } ?>

                        </ul> 
                    
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <?php
        }

        public function LogSidebar()
        {
            $logs = $this->log_data();
            if (empty($logs) && !is_array($logs)) {
                return;
            }
            ?>
                <div class="redq-admin-dashboard-log-sidebar">
                    <h2 class="redq-admin-dashboard-log-sidebar-title"><?php echo esc_html__( "Changelog", "cartsy-lite" ); ?></h2>

                    <ul class="redq-admin-dashboard-lists">
                        <?php
                        $index = 0;
                        foreach ($logs as $key => $log) { $index++; ?>
                            <li data-key="<?php echo esc_attr( $key ) ?>" class="<?php echo esc_attr($index === 1 ? "active" : ""); ?>">
                                <a class="redq-admin-dashboard-list-link" href="#<?php echo esc_attr( 'redq-dashboard-changelog-v-' . $key )?>"><?php echo esc_html( $key ) ?></a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </div>
            <?php
        }
    }
}