<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_replace_special_vars')) {

    function reboot_replace_special_vars($str)
    {
//        if(strpos($str, 'email') !== false) {
//            reboot_dd($str);
//        }

        // bail early
        if (empty($str)) {
            return $str;
        }

        $data = [
            '{Y}' => date('Y'),
            '{br}' => '<br>',
            '{title}' => get_the_title(),
        ];

        // get "call" definitions
        $re = '/\{call:([^\}]+)\}/m';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        if (!empty($matches)) {
            foreach ($matches as $match) {

                if (array_key_exists($match[0], $data)) {
                    continue;
                }

                // get method and params
                $params = [];
                $re_params = '/(.*)\(([^\)]+)\)/m';
                preg_match_all($re_params, $match[1], $matches_params, PREG_SET_ORDER, 0);
                if (!empty($matches_params)) {
                    $callback = trim($matches_params[0][1]);
                    $params = array_map('trim', explode(",", $matches_params[0][2]));
                } else {
                    $callback = trim($match[1]);
                }

                // detect class->method definition
                if (strpos($callback, '->') !== false) {
                    $callback = explode('->', $callback);
                }

                // check callable
                if (is_callable($callback)) {
                    $data[$match[0]] = call_user_func_array($callback, $params);
                }

            }
        }

        // get "i" and "span" definitions
        $re = '/\{(i|span) ([^\}]+)\}/m';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        if (!empty($matches)) {
            foreach ($matches as $match) {

                if (array_key_exists($match[0], $data)) {
                    continue;
                }

                $data[$match[0]] = sprintf('<%1$s class="%2$s"></%1$s>', $match[1], $match[2]);
            }
        }

        if(empty($data)) {
            return $str;
        }

        return str_replace(
            array_keys($data),
            array_values($data),
            $str
        );
    }

}