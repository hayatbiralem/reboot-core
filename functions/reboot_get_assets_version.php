<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_assets_version')) {

    function reboot_get_assets_version($file_path, $check_file = true)
    {
        if(!$check_file || ($check_file && file_exists($file_path))) {
            return date("ymd-Gis", filemtime($file_path));
        }

        return REBOOT_ASSETS_VERSION;
    }

}