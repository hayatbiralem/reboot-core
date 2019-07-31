<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_check_dependency')) {

    function reboot_check_dependency($callable, $error_message = '')
    {
        if(!is_callable($callable)) {
            if(empty($error_message)) {
                $error_message = __('Error!', REBOOT_CORE_TEXT_DOMAIN);
            }

            throw new \Exception($error_message);
        }

        return true;
    }

}