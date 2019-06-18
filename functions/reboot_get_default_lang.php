<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_default_lang')) {

    /**
     * Get current language
     *
     * @return string
     */
    function reboot_get_default_lang()
    {
        global $sitepress;

        if($sitepress) {
            return $sitepress->get_default_language();
        }

        return 'tr';
    }

}