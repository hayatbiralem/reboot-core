<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!function_exists('reboot_get_transient')) {

    function reboot_get_transient($key, $default = null)
    {
        $transient = get_transient($key);
        if( ! empty( $transient ) ) {
            return $transient;
        } else {
            return $default;
        }
    }

}