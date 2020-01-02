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
    function reboot_d($var, $param_to_check = null, $return = false)
    {
        if(!reboot_request_has_param($param_to_check)) {
            return false;
        }

        ob_start();
        echo '<pre>';
        echo htmlspecialchars(var_export($var, true));
        echo '</pre>';
        $output = ob_get_clean();

        if($return) {
            return $output;
        }

        echo $output;
        return false;
    }

}