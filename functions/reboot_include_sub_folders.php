<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_include_sub_folders')) {

    /**
     * Include PHP files in given folder name
     *
     * @param $folder
     */
    function reboot_include_sub_folders($root_path, $exclude_underscored_folders = true)
    {
        $sub_folders = reboot_get_sub_folders($root_path, $exclude_underscored_folders);
        if(!empty($sub_folders)) {
            foreach ($sub_folders as $sub_folder) {
                reboot_include_folder($sub_folder['path']);
            }
        }
    }

}