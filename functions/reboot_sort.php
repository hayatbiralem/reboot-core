<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_sort')) {

    /**
     * @param array $arr
     * @return array
     */
    function reboot_sort($arr)
    {
        usort($arr, 'reboot_turkish_string_comparison');
        return $arr;
    }

}