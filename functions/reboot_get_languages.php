<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_languages')) {

    /**
     * Get current language
     *
     * @return string
     */
    function reboot_get_languages()
    {
        global $sitepress;

        if($sitepress) {
            parse_str('skip_missing=0&orderby=custom', $res);
            return $sitepress->get_ls_languages( $res );
        }

        return false;
    }

}