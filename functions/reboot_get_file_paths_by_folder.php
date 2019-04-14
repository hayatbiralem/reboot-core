<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_get_file_paths_by_folder')) {

    function reboot_get_file_paths_by_folder($root_path, $root_url, $folder, $file, $exclude_underscored_folders = true)
    {
        $files = [];

        if(!file_exists($root_path)) {
            return $files;
        }

        $sub_dirs = array_filter(glob($root_path . $folder . '/*'), 'is_dir');
        if (!empty($sub_dirs) && is_array($sub_dirs)) {
            foreach ($sub_dirs as $sub_dir) {
                $sub_dir_name = basename($sub_dir);

                $is_underscored = $sub_dir_name[0] == '_' ? true : false;

                if($exclude_underscored_folders && $is_underscored) {
                    continue;
                }

                $base_path = $sub_dir . '/';
                $file_path = $base_path . $file;
                if (file_exists($file_path)) {
                    $relative_path = $folder . '/' . $sub_dir_name . '/';
                    $base_url = $root_url . $relative_path;
                    $file_url = $base_url . $file;
                    $files[] = [
                        'base_url' => $base_url,
                        'base_path' => $base_path,
                        'file_path' => $file_path,
                        'file_url' => $file_url,
                        'relative_path' => $relative_path,
                        'sub_dir_name' => $sub_dir_name,
                        'is_underscored' => $is_underscored,
                    ];
                }
            }
        }

        return $files;
    }

}