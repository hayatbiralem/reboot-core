<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_parse_params')) {

    function reboot_parse_params($str)
    {
        if(empty($str)) {
            return false;
        }

        $re = '/([^\s]+)="([^"]+)"/m';
        preg_match_all($re, $str, $atts, PREG_SET_ORDER, 0);

        if(empty($atts)) {
            return false;
        }

        $params = [];

        foreach ($atts as $attr) {
            $params[ $attr[1] ] = $attr[2];
        }

        return $params;
    }

}