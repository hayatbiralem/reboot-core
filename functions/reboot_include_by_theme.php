<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_include_by_theme')) {

    /**
     * Include By Theme
     * Check and include once
     *
     * @param string $file
     * @param bool $once
     * @return bool
     */

    function reboot_include_by_theme($file = '', $once = true)
    {
        $status = false;

        if (empty($file)) {
            return $status;
        }

        $paths = [];

        if (REBOOT_IS_CHILD) {
            $paths[] = REBOOT_CHILD_PATH . REBOOT_DIRECTORY_NAME . '/' . $file . '.php';
        }

        $paths[] = REBOOT_TEMPLATE_PATH . REBOOT_DIRECTORY_NAME . '/' . $file . '.php';

        foreach ($paths as $path) {
            if (!is_file($path)) {
                continue;
            }

            if ($once) {
                include_once $path;
            } else {
                include $path;
            }

            $status = true;
        }

        return $status;
    }

}

