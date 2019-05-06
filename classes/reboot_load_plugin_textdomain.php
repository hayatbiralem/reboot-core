<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_load_plugin_textdomain')) {

    class reboot_load_plugin_textdomain
    {

        function __construct()
        {
            add_action('plugins_loaded', [$this, 'load_textdomain'], 10);
        }

        function load_textdomain()
        {
            if ( is_textdomain_loaded( REBOOT_CORE_TEXT_DOMAIN ) ) {
                return;
            }

            load_plugin_textdomain(REBOOT_CORE_TEXT_DOMAIN, false, REBOOT_CORE_DIRECTORY_NAME . '/languages');
        }

    }

    new reboot_load_plugin_textdomain();

}

