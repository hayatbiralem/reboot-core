<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_require_file')) {

    /**
     * Include PHP files in given folder name
     *
     * @param $file
     */
    function reboot_require_file($file, $once = true)
    {
        if (file_exists($file)) {
            if($once) {
                require_once $file;
            } else {
                require $file;
            }
        }
    }

}