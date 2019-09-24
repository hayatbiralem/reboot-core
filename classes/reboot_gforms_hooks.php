<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_gforms_hooks')) {

    class reboot_gforms_hooks
    {

        function __construct()
        {
            add_filter('option_rg_gforms_message', [$this, 'option_rg_gforms_message'], 10, 2);
        }

        function option_rg_gforms_message($value, $option)
        {
            if(strpos($value, 'unregistered') !== false) {
                $value = '';
            }
            return $value;
        }

    }

    new reboot_gforms_hooks();

}
