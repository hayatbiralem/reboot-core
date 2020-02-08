<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_truncate')) {
    /**
     *  This function shortens a string
     */
    function reboot_truncate($string, $limit, $break = ".", $pad = "...", $stripClean = false, $excludetags = '<strong><em><span>', $safe_truncate = false)
    {
        if ($stripClean) {
            $string = strip_shortcodes(strip_tags($string, $excludetags));
        }

        if (strlen($string) <= $limit) return $string;

        if (false !== ($breakpoint = strpos($string, $break, $limit))) {
            if ($breakpoint < strlen($string) - 1) {
                if ($safe_truncate || is_rtl()) {
                    $string = mb_strimwidth($string, 0, $breakpoint) . $pad;
                } else {
                    $string = substr($string, 0, $breakpoint) . $pad;
                }
            }
        }

        // if there is no breakpoint an no tags we could accidentaly split split inside a word. we also dont want to split links
        if (!$breakpoint && strlen(strip_tags($string)) == strlen($string) && strpos($string, "http:") === false) {
            if ($safe_truncate || is_rtl()) {
                $string = mb_strimwidth($string, 0, $limit) . $pad;
            } else {
                $string = substr($string, 0, $limit) . $pad;
            }
        }

        return $string;
    }
}