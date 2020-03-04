<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_d')) {

    /**
     * @param $var
     * @param null $param_to_check
     * @param bool $echo
     * @return mixed
     */
    function reboot_d($var, $param_to_check = null, $return = false, $escape_html = true)
    {
        if(!reboot_request_has_param($param_to_check)) {
            return false;
        }

        $output = var_export($var, true);

        if($escape_html) {
            $output = htmlentities($output);
        }

        $output = sprintf('<pre>%s</pre>', $output);

        if($return) {
            return $output;
        }

        echo $output;
        return false;
    }

}