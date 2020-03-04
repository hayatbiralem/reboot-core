<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_extract_body_from_html_string')) {

    function reboot_extract_body_from_html_string($html)
    {
        $re = '/<body[^>]*>(.*?)<\/body>/is';
        preg_match_all($re, $html, $matches, PREG_SET_ORDER, 0);

        if(isset($matches[0][1])) {
            $html = $matches[0][1];
        }

        return $html;
    }

}