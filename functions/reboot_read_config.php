<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_read_config')) {

    /**
     * @param $file
     * @param string $key
     * @return mixed
     */
    function reboot_read_config($file, $key = '', $default = '')
    {
        global $reboot_read_config_collection, $reboot_read_config_last_error;

        if (!isset($reboot_read_config_collection)) {
            $reboot_read_config_collection = [];
        }

        if (array_key_exists($file, $reboot_read_config_collection)) {
            return $reboot_read_config_collection[$file];
        }

        if (file_exists($file)) {
            $str = file_get_contents($file);
            if ($str) {
                try {
                    $json = json_decode($str, true);
                    $reboot_read_config_collection[$file] = $json;
                } catch (\Exception $err) {
                    $reboot_read_config_last_error = $err;
                }
            }
        }

        if (!array_key_exists($file, $reboot_read_config_collection)) {
            $reboot_read_config_collection[$file] = false;
        }

        if(!empty($reboot_read_config_collection[$file]) && !empty($key)) {
            if(isset($reboot_read_config_collection[$file][$key]) && !empty($reboot_read_config_collection[$file][$key])) {
                return $reboot_read_config_collection[$file][$key];
            } else {
                return $default;
            }
        }

        return $reboot_read_config_collection[$file];
    }

}