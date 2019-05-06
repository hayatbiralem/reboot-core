<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_include_file')) {

    /**
     * Include PHP files in given folder name
     *
     * @param $file
     */
    function reboot_include_file($file, $once = true)
    {
        if (file_exists($file)) {
            if($once) {
                include_once $file;
            } else {
                include $file;
            }
        }
    }

}