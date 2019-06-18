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

    function reboot_acf_set_language() {
        global $sitepress;

        if($sitepress) {
            return $sitepress->get_default_language();
        }

        return '';
    }

    function reboot_get_global_option($name) {
        global $sitepress;
        if($sitepress) {
            add_filter('acf/settings/current_language', 'reboot_acf_set_language', 100);
        }
        $option = get_field($name, 'option');
        if($sitepress) {
            remove_filter('acf/settings/current_language', 'reboot_acf_set_language', 100);
        }
        return $option;
    }

}