<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!function_exists('reboot_fix_unclosed_html_tags')) {

    /**
     * Fix unclosed html tags
     *
     * @param string $content
     * @return string
     */
    function reboot_fix_unclosed_html_tags($content)
    {
        $doc = new DOMDocument();
        @$doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        $html = $doc->saveHTML();

        $re = '/<body[^>]*>(.*?)<\/body>/is';
        preg_match_all($re, $html, $matches, PREG_SET_ORDER, 0);

        if(isset($matches[0][1])) {
            $content = $matches[0][1];
        }

        return $content;
    }

}