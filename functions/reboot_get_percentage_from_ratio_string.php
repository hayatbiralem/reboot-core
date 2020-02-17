<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_get_percentage_from_ratio_string')) {

    function reboot_get_percentage_from_ratio_string($ratio_string)
    {
        if(strpos($ratio_string, ':') !== false) {
            $pieces = explode(':', $ratio_string);
            $width = intval($pieces[0]);
            $height = intval($pieces[1]);
            if($width <= 0 || $height <= 0) {
                return 0;
            }
            
            return round(100 * $height / $width, 8);
        }

        return 0;
    }

}