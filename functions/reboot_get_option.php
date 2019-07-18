<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_option')) {

    function reboot_get_option($name = '')
    {
        $value = get_field($name, 'option');

        if(reboot_is_empty($value) && !reboot_is_default_lang()) {
            return reboot_get_global_option($name);
        }

        return $value;
    }

    function reboot_get_global_option($name) {
        add_filter('acf/settings/current_language', '__return_false', 100);
        $option = get_field($name, 'option');
        remove_filter('acf/settings/current_language', '__return_false', 100);

        return $option;
    }

}