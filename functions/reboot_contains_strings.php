<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_contains_strings')) {

    function reboot_contains_strings($haystack, $strings_array){
        $haystack = sanitize_title($haystack);
        $haystack = preg_replace('!\s+!', ' ', $haystack);

        $result = true;

        foreach ($strings_array as $key => $val) {
            if( stripos(sanitize_title($val), $haystack) === false ) {
                $result = false;
                break;
            }
        }

        return $result;
    }

}