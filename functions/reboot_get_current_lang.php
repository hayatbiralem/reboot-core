<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_current_lang')) {

    /**
     * Get current language
     *
     * @return string
     */
    function reboot_get_current_lang()
    {
        return apply_filters( 'wpml_current_language', NULL );
    }

}