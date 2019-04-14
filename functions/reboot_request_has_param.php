<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_request_has_param')) {

    function reboot_request_has_param($param_name)
    {
        if(!empty($param_name) && !isset($_REQUEST[$param_name])) {
            return false;
        }

        return true;
    }

}