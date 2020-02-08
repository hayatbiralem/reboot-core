<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_list_all_shortcodes')) {

    function reboot_list_all_shortcodes()
    {
        add_action('get_header', function () {
            global $shortcode_tags;
            $available_shortcodes = array_keys($shortcode_tags);
            sort($available_shortcodes);
            reboot_dd( $available_shortcodes );
        }, 999999);
    }

}