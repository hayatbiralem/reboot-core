<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_breadcrumb')) {

    function reboot_breadcrumb($items = [], $wrapper_template = '<ol class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">%s</ol>')
    {
        if(empty($items)) {
            return '';
        }

        $link_item_template = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="%s" title="">%s</a></li>';
        $current_item_template = '<li class="current">%s</li>';
        $html = [];

        foreach ($items as $item) {
            if(isset($item['url'])) {
                $html[] = sprintf($link_item_template, $item['url'], $item['title']);
            } else {
                $html[] = sprintf($current_item_template, $item['title']);
            }
        }

        if(empty($html)) {
            return '';
        }

        return sprintf($wrapper_template, implode("\n", $html));
    }

}