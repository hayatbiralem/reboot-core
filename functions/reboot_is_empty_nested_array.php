<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_is_empty_nested_array')) {

    function reboot_is_empty_nested_array($array){
        return empty( reboot_remove_empty_values_from_nested_array( $array ) );
    }

}