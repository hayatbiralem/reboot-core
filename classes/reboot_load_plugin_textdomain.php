<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_load_plugin_textdomain')) {

    class reboot_load_plugin_textdomain
    {

        function __construct()
        {
            // add_action('init', [$this, 'load_textdomain']);
            $this->load_textdomain();
        }

        function load_textdomain()
        {

            if ( is_textdomain_loaded( REBOOT_CORE_TEXT_DOMAIN ) ) {
                return;
            }

            load_plugin_textdomain(REBOOT_CORE_TEXT_DOMAIN, false,  'reboot-core/languages');
        }

    }

    new reboot_load_plugin_textdomain();

}

