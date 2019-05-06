<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
};

if (!class_exists('reboot_front_end_scripts')) {

    class reboot_front_end_scripts
    {

        function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'front_end_scripts'), 999999, 0);
        }

        /**
         * Front-end scripts
         */
        function front_end_scripts()
        {
            /**
             * Path Collections
             */

            $scripts = [];
            $styles = [];


            /**
             * Scripts
             */

            $bothend_scripts = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'bothend/js', 'script.js');
            $frontend_scripts = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'frontend/js', 'script.js');

            $child_bothend_scripts = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/bothend/js', 'script.js');
            $child_frontend_scripts = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/frontend/js', 'script.js');


            /**
             * Styles
             */

            $bothend_styles = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'bothend/css', 'style.css');
            $frontend_styles = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'frontend/css', 'style.css');

            $bothend_fonts = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'bothend/font', 'style.css');
            $frontend_fonts = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'frontend/font', 'style.css');

            $child_bothend_styles = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/bothend/css', 'style.css');
            $child_frontend_styles = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/frontend/css', 'style.css');

            $child_bothend_fonts = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/bothend/font', 'style.css');
            $child_frontend_fonts = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/frontend/font', 'style.css');


            /**
             * Merge
             */

            $scripts = array_merge($scripts, $bothend_scripts, $frontend_scripts, $child_bothend_scripts, $child_frontend_scripts);
            $styles = array_merge($styles, $bothend_styles, $frontend_styles, $bothend_fonts, $frontend_fonts, $child_bothend_styles, $child_frontend_styles, $child_bothend_fonts, $child_frontend_fonts);

            // reboot_dd($scripts);


            /**
             * Enqueue
             */

            // Scripts
            if (!empty($scripts)) {
                foreach ($scripts as $file) {
                    $handle = REBOOT_AGENCY_SLUG . '-' . sanitize_title($file['relative_path']);
                    reboot_javascript_translations::load_translations($file['base_path'] . 'translations.php', $handle );
                    $deps = reboot_read_config($file['base_path'] . 'config.json', 'deps', []);
                    wp_enqueue_script($handle, $file['file_url'], $deps, reboot_get_assets_version($file['file_path'], false));
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
    }

    new reboot_front_end_scripts();

}

