<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_remove_empty_tags')) {

    function reboot_remove_empty_tags($html, $tags)
    {
        if (empty($html) || empty($tags)) {
            return $html;
        }

        if (is_string($tags)) {
            $tags = [$tags];
        }

        foreach ($tags as $tag) {
            if ($tag == 'all') {
                $pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
            } else {
                $pattern = "/<{$tag}[^>]*>([\s]?)*<\/{$tag}[^>]*>/";
            }

            $html = preg_replace($pattern, '', $html);
        }

        return $html;
    }

}

if (!function_exists('reboot_remove_empty_tags_v2')) {

    function reboot_remove_empty_tags_v2($html, $tags)
    {
        if (empty($html) || empty($tags)) {
            return $html;
        }

        if (is_string($tags)) {
            $tags = [$tags];
        }

        $doc = new DOMDocument();
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        foreach ($tags as $tag) {
            foreach($doc->getElementsByTagName($tag) as $element) {
                if(trim($element->innertext) == '') {
                    $element->outertext = '';
                }
            }
        }

        $html = $doc->saveHTML();

        return reboot_extract_body_from_html_string($html);
    }

}
