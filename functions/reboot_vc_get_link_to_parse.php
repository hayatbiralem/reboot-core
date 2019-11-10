<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_vc_get_link_to_parse')) {

    function reboot_vc_get_link_to_parse($arr = [])
    {
        if(empty($arr) || !isset($arr['url'])) {
            return '||';
        }

        $str = [];
        foreach ($arr as $key => $val) {
            if($val) {
                if($key == 'url') {
                    $str[] = $key . ':' . urlencode($val);
                } else {
                    $str[] = $key . ':' . $val;
                }
            } else {
                $str[] = '';
            }
        }
        return implode('|', $str);
    }

}