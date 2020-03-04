<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_search_array')) {

    function reboot_search_array($array, $search){
        $out = [];
        $search = sanitize_title($search);
        // $search = preg_replace('!\s+!', ' ', $search);

        foreach ($array as $key => $title) {
            if( strpos(sanitize_title($title), $search) !== false ) {
                $out[$key] = $title;
            }
        }

        return $out;
    }

}