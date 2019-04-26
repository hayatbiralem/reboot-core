<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_get_local_data')) {

    /**
     * @param $var
     * @param null $param_to_check
     * @param bool $echo
     * @return mixed
     */
    function reboot_get_local_data($key, $lang = 'en')
    {
        if (!$key) {
            return sprintf(__('Key not found: %s', REBOOT_TEXT_DOMAIN), $key);
        }

        $file = REBOOT_DATA_PATH . $key . '/' . $lang . '.json';
        if (!file_exists($file)) {
            return sprintf(__('File not found: %s', REBOOT_TEXT_DOMAIN), $file);
        }

        $str = file_get_contents($file);
        $json = json_decode($str, true);

        return $json;
    }

}