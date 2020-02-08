<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_strpos_array')) {

    function reboot_strpos_array($haystack, $needle, $offset=0) {
        if(!is_array($needle)) $needle = array($needle);
        foreach($needle as $query) {
            if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
        }
        return false;
    }

}