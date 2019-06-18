<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_is_default_lang')) {

    /**
     * Get current language
     *
     * @return string
     */
    function reboot_is_default_lang()
    {
        return reboot_get_current_lang() == reboot_get_default_lang() ? true : false;
    }

}