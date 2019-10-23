<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_agency_logo')) {

    function reboot_agency_logo($svg = '')
    {
        if(empty($svg)) {
            return;
        }

        echo sprintf('<a class="c-agency-logo" title="' . REBOOT_AGENCY . '" href="' . REBOOT_AGENCY_URL . '" target="_blank" rel="nofollow">%s</a>', $svg);
    }

}