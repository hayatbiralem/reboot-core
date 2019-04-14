<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_key')) {

    function reboot_key($name_title_etc, $underscored = false)
    {
        $key = sanitize_title($name_title_etc);

        if($underscored) {
            $key = str_replace('-', '_', $key);
        }

        return $key;
    }

}