<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_gforms_hooks')) {

    class reboot_gforms_hooks
    {

        function __construct()
        {
            add_filter('option_rg_gforms_message', [$this, 'option_rg_gforms_message'], 10, 2);
            add_filter('gravityview/admin/notices', [$this, 'gravityview_admin_notices'], 10, 1);
        }

        function option_rg_gforms_message($value, $option)
        {
            if(strpos($value, 'unregistered') !== false) {
                $value = '';
            }
            return $value;
        }

        function gravityview_admin_notices($notices)
        {
            $new_notices = [];
            foreach ($notices as $notice) {
                if(strpos($notice['title'], 'License') === false && strpos($notice['title'], 'Lisans') === false) {
                    $new_notices[] = $notice;
                }
            }

            return $new_notices;
        }

    }

    new reboot_gforms_hooks();

}
