<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_maybe_custom_image_dimension')) {

    function reboot_maybe_custom_image_dimension($image_size)
    {
        if(!is_string($image_size)) {
            return $image_size;
        }

        $re = '/(\d+)x(\d+)/m';

        if(preg_match_all($re, $image_size, $matches, PREG_SET_ORDER, 0)) {
            return [
                $matches[0][1],
                $matches[0][2],
            ];
        }

        return $image_size;
    }

}