<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_ignite_up_vc_icon_issue_fix')) {

    class reboot_ignite_up_vc_icon_issue_fix
    {

        function __construct()
        {
            add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'], 99);
        }

        function admin_enqueue_scripts()
        {
            wp_deregister_style('rockyton-icon');
        }

    }

    new reboot_ignite_up_vc_icon_issue_fix();

}


