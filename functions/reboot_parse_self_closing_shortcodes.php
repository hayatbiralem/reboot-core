<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_parse_self_closing_shortcodes')) {

    function reboot_parse_self_closing_shortcodes($tags, $str)
    {
        $shortcodes = [];
        $re = '/\[('.implode('|', $tags).')(\s[^\]]+)?\]/m';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        if(!empty($matches)) {
            foreach ($matches as $match) {
                $full_match = $match[0];
                $tag = $match[1];
                $params = $match[2];

                if(!empty($params)) {
                    $params = reboot_parse_params($params);
                }

                if(empty($params)) {
                    $params = [];
                }

                $shortcodes[] = [
                    'tag' => $tag,
                    'full_match' => $full_match,
                    'params' => $params,
                ];
            }
        }

        return $shortcodes;
    }

}