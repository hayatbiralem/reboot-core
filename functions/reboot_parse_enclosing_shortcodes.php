<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_parse_enclosing_shortcodes')) {

    function reboot_parse_enclosing_shortcodes($tags, $str)
    {
        $shortcodes = [];

        foreach ($tags as $tag) {
            $re = '/\[('.$tag.')(\s[^\]]+)?\](.*?)\['.$tag.'_end\]/ms';
            preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
            if(!empty($matches)) {
                foreach ($matches as $match) {
                    $full_match = $match[0];
                    $tag = $match[1];
                    $params = $match[2];
                    $content = $match[3];

                    if(!empty($params)) {
                        $params = reboot_parse_params($params);
                    }

                    if(empty($params)) {
                        $params = [];
                    }

                    $params['content'] = $content;

                    $shortcodes[] = [
                        'tag' => $tag,
                        'full_match' => $full_match,
                        'params' => $params,
                    ];
                }
            }
        }

        return $shortcodes;
    }

}