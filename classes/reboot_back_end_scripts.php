<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
};

if (!class_exists('reboot_back_end_scripts')) {

    class reboot_back_end_scripts
    {

        function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'back_end_scripts'), 99, 0);
            add_action('admin_print_styles', array($this, 'admin_print_styles'), 99, 0);
        }

        /**
         * Enqueue styles & scripts
         */
        function back_end_scripts()
        {
            /**
             * Path Collections
             */

            $scripts = [];
            $styles = [];


            /**
             * Scripts
             */

            $both_end_scripts = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'bothend/js', 'script.js');
            $child_back_end_scripts = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/backend/js', 'script.js');


            /**
             * Styles
             */

            $back_end_styles = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'backend/css', 'style.css');

            $both_end_styles = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'bothend/css', 'style.css');
            $both_end_fonts = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'bothend/font', 'style.css');

            $child_back_end_styles = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/backend/css', 'style.css');


            /**
             * Merge
             */

            $scripts = array_merge($scripts, $both_end_scripts, $child_back_end_scripts);
            $styles = array_merge($styles, $both_end_fonts, $both_end_styles, $back_end_styles, $child_back_end_styles);


            /**
             * Enqueue
             */

            // Scripts
            $first = true;
            if (!empty($scripts)) {
                foreach ($scripts as $file) {
                    $handle = REBOOT_AGENCY_SLUG . '-' . sanitize_title($file['relative_path']);
                    reboot_javascript_translations::load_translations($file['base_path'] . 'translations.php', $handle );
                    $deps = reboot_read_config($file['base_path'] . 'config.json', 'deps', []);
                    wp_enqueue_script($handle, $file['file_url'], $deps, reboot_get_assets_version($file['file_path'], false));

                    if($first) {
                        $first = false;
                        wp_localize_script( $handle, 'reboot_core', [
                            'ajax_url' => admin_url( 'admin-ajax.php' ),
                            'security'  => wp_create_nonce( REBOOT_NONCE_KEY ),
                            'current_url' => add_query_arg(),
                        ] );
                    }
                }
            }

            // Styles
            if (!empty($styles)) {
                foreach ($styles as $file) {
                    $deps = reboot_read_config($file['base_path'] . 'config.json', 'deps', []);
                    wp_enqueue_style(REBOOT_AGENCY_SLUG . '-' . sanitize_title($file['relative_path']), $file['file_url'], $deps, reboot_get_assets_version($file['file_path'], false));
                }
            }
        }


        /**
         * Inline styles
         */
        function admin_print_styles()
        {
            ?>
            <style>
                [class^="dashicons-reboot-"]:before,
                [class*=" dashicons-reboot-"]:before {
                    font-family: inherit !important;
                }
            </style>
            <?php
        }
    }

    new reboot_back_end_scripts();

}

