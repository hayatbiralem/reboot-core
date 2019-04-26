<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_minutes_to_hours')) {

    function reboot_minutes_to_hours($time) {
        $time = intval($time);

        if ($time < 1) {
            return sprintf(__('%s min', REBOOT_TEXT_DOMAIN), '0');
        }

        $hours = floor($time / 60);
        $minutes = ($time % 60);

        $format_hours = sprintf(_n( '%d hr', '%d hrs', $hours, REBOOT_TEXT_DOMAIN ), $hours);
        $format_minutes = sprintf(_n( '%d min', '%d mins', $minutes, REBOOT_TEXT_DOMAIN ), $minutes);

        if($hours > 0) {
            $format = sprintf('%s %s', $format_hours, $format_minutes);
        } else {
            $format = $format_minutes;
        }

        return sprintf($format, $hours, $minutes);
    }

}
