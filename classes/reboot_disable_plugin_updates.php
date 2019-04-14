<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_disable_plugin_updates')) {

    class reboot_disable_plugin_updates
    {

        function __construct()
        {
            add_filter('site_transient_update_plugins', [$this, 'disable_plugin_updates']);
        }

        function disable_plugin_updates($value)
        {
            if (isset($value) && is_object($value)) {
                $to_disable = [
                    'advanced-custom-fields-pro/acf.php'
                ];

                $to_disable = apply_filters('reboot_disable_plugin_updates', $to_disable);

                foreach ($to_disable as $item) {
                    if (isset($value->response[$item])) {
                        unset($value->response[$item]);
                    }
                }
            }
            return $value;
        }

    }

    new reboot_disable_plugin_updates();

}
