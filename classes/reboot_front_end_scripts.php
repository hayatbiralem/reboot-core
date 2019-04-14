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
            // path => [deps]
            $scripts = [];

            // path => [deps]
            $styles = [];

            // css
            $styles = array_merge($styles, reboot_get_assets_by_folder('bothend/css'));

            // fonts
            $styles = array_merge($styles, reboot_get_assets_by_folder('bothend/font'));


            // Scripts
            if (!empty($scripts)) {
                foreach ($scripts as $script => $deps) {
                    if (file_exists(REBOOT_ASSETS_PATH . $script)) {
                        wp_enqueue_script(REBOOT_AGENCY_SLUG . '-' . sanitize_title($script), REBOOT_ASSETS_URL . $script, $deps, reboot_get_assets_version(REBOOT_ASSETS_PATH . $script, false));
                    }
                }
            }

            // Styles
            if (!empty($styles)) {
                foreach ($styles as $style => $deps) {
                    if (file_exists(REBOOT_ASSETS_PATH . $style)) {
                        wp_enqueue_style('reboot-' . sanitize_title($style), REBOOT_ASSETS_URL . $style, $deps, reboot_get_assets_version(REBOOT_ASSETS_PATH . $style, false));
                    }
                }
            }
        }
    }

    new reboot_front_end_scripts();

}

