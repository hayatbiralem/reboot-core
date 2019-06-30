<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_map_url')) {

    function reboot_map_url($lat, $lng)
    {
        return "https://maps.google.com/?q={$lat},{$lng}";
    }

}