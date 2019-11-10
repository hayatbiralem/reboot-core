<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!function_exists('reboot_set_transient')) {

    function reboot_set_transient($key, $content = null, $expiration = YEAR_IN_SECONDS)
    {
        set_transient( $key, $content, $expiration );
    }

}