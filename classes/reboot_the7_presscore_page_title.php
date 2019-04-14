<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!class_exists('reboot_the7_presscore_page_title')) {

    class reboot_the7_presscore_page_title{

        function __construct()
        {
            add_filter('presscore_page_title', [$this, 'fancy_title_tag']);
        }

        function fancy_title_tag( $title_html ){

            $reboot_fancy_title_tag = get_field('reboot_fancy_title_tag');

            if(!empty($reboot_fancy_title_tag) && $reboot_fancy_title_tag != 'h1') {
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
            }

            return $title_html;
        }

    }

    new reboot_the7_presscore_page_title();

}

