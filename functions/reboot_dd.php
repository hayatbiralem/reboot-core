<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_dd')) {

    /**
     * @param $var
     * @param null $param_to_check
     * @return void
     */
    function reboot_dd($var, $param_to_check = null)
    {
        if(!reboot_request_has_param($param_to_check)) {
            return;
        }

        reboot_d($var);
        die;
    }

}