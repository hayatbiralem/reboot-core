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

        echo sprintf('<a class="c-agency-logo" title="Reboot" href="https://reboot.com.tr" target="_blank" rel="nofollow">%s</a>', $svg);

    }

}