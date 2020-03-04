<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_the7_presscore_page_title')) {

    class reboot_the7_presscore_page_title
    {

        function __construct()
        {
            add_filter('presscore_page_title', [$this, 'fancy_title_tag']);
            add_filter('wp_footer', [$this, 'custom_page_title_image']);
        }

        function fancy_title_tag($title_html)
        {

            if (!function_exists('get_field')) {
                return $title_html;
            }

            $reboot_fancy_title_tag = get_field('reboot_fancy_title_tag');

            if (empty($reboot_fancy_title_tag) || $reboot_fancy_title_tag == 'h1') {
                return $title_html;
            }

            $title_html = str_replace(
                [
                    '<h1 ',
                    '</h1>',
                ],
                [
                    "<{$reboot_fancy_title_tag} ",
                    "</{$reboot_fancy_title_tag}>",
                ],
                $title_html
            );

            return $title_html;
        }

        function custom_page_title_image()
        {
            if (!function_exists('get_field')) {
                return;
            }

            $custom_page_title_image = get_field('custom_page_title_image');
            if(empty($custom_page_title_image)) {
                return;
            }

            ?>
            <style>
                #page .page-title,
                #page .page-title.solid-bg.bg-img-enabled {
                    background-image: url(<?= $custom_page_title_image['url'] ?>);
                }
            </style>
            <?php
        }

    }

    new reboot_the7_presscore_page_title();

}

