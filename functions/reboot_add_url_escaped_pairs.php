<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_add_url_escaped_pairs')) {

    function reboot_add_url_escaped_pairs($arr)
    {
        $vars = [];
        foreach ($arr as $key => $value) {
            $key = esc_url($key);
            if (!isset($vars[$key])) {
                $vars[$key] = esc_url($value);
            }
        }
        return array_merge($arr, $vars);
    }

}