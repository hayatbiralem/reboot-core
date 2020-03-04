<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_get_google_map_api_key')) {

    function reboot_get_google_map_api_key()
    {
        /**
         * Get API Key from Theme Options
         *
         * So we do not need to update that key in code.
         *
         * Nice :)
         */

        if (function_exists('bsf_get_option')) {
            $google_maps_api_key = get_field('google_maps_api_key', 'option');
            if (!empty($google_maps_api_key)) {
                $key = $google_maps_api_key;
            }
        }

        /**
         * Get API Key from Bee Themes Setting
         */

        if (empty($key) && function_exists('bsf_get_option')) {
            $key = bsf_get_option('map_key');
        }

        return $key;
    }

}