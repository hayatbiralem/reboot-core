<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_get_sub_folders')) {

    /**
     * Include PHP files in given folder name
     *
     * @param $folder
     */
    function reboot_get_sub_folders($root_path, $exclude_underscored_folders = true)
    {
        $sub_folders = [];
        if (file_exists($root_path)) {
            $sub_dirs = array_filter(glob($root_path . '/*'), 'is_dir');
            if (!empty($sub_dirs) && is_array($sub_dirs)) {
                foreach ($sub_dirs as $sub_dir) {
                    $sub_dir_name = basename($sub_dir);
                    $is_underscored = $sub_dir_name[0] == '_' ? true : false;
                    if($exclude_underscored_folders && $is_underscored) {
                        continue;
                    }

                    $sub_folders[] = [
                        'name' => $sub_dir_name,
                        'path' => $sub_dir,
                        'is_underscored' => $is_underscored,
                    ];
                }
            }
        }
        return $sub_folders;
    }

}