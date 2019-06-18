<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_remove_empty_values_from_nested_array')) {

    function reboot_remove_empty_values_from_nested_array($array){
        if(is_array($array)) {
            $json_encoded_arr = json_encode($array, JSON_UNESCAPED_UNICODE);
        } else {
            $json_encoded_arr = $array;
        }

        $re = '/\,?"[^"]*":""/m';
        $json_encoded_arr = str_replace('{}', '""', $json_encoded_arr);
        if(preg_match($re, $json_encoded_arr)){
            $json_encoded_arr = preg_replace($re, '', $json_encoded_arr);
            return reboot_remove_empty_values_from_nested_array($json_encoded_arr);
        }
        return array_filter(array_map(function ($val){ return array_filter((array) $val); }, (array)json_decode($json_encoded_arr, true)));
    }

}