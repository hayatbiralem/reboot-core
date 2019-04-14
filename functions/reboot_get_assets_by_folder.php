<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_get_assets_by_folder')) {

    function reboot_get_assets_by_folder($folder, $deps = [])
    {
        $assets = [];

        $sub_dirs = array_filter(glob(REBOOT_ASSETS_PATH . $folder . '/*'), 'is_dir');
        if (!empty($sub_dirs) && is_array($sub_dirs)) {
            foreach ($sub_dirs as $sub_dir) {
                $style_file_dir = $sub_dir . '/style.css';
                if (file_exists($style_file_dir)) {
                    $style_file_url = $folder . '/' . basename($sub_dir) . '/' . 'style.css';
                    $assets[$style_file_url] = $deps;
                }
            }
        }

        return $assets;
    }

}