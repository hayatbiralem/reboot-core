<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_get_template_formatters')) {

    function reboot_get_template_formatters()
    {
        $formatters = apply_filters('reboot_template_formatters', []);

        /*
        $formatters['Function Name'] = 'function_name';
        $formatters['Method Name'] = 'class::static_method_name';
         */

        return $formatters;
    }

}