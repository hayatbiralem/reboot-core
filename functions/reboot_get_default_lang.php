<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_default_lang')) {

    /**
     * Get current language
     *
     * @return string
     */
    function reboot_get_default_lang()
    {
        return apply_filters( 'wpml_default_language', NULL );
    }

}