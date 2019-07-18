<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_is_empty')) {

    function reboot_is_empty($any)
    {
        if(empty($any)) {
            return true;
        }

        if((is_array($any) && reboot_is_empty_nested_array($any))) {
            return true;
        }

        return false;
    }

}