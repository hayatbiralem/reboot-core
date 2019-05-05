<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_responsive_embed_for_wp_videos')) {

    class reboot_responsive_embed_for_wp_videos
    {

        function __construct()
        {
            add_filter('embed_oembed_html', [$this, 'embed_html'], 10, 3);
            add_filter('video_embed_html', [$this, 'embed_html']);
            add_filter('wp_head', [$this, 'print_styles']);
        }

        function embed_html($html)
        {
            $html = '<div class="o-responsive-embed">' . $html . '</div>';
            return $html;
        }

        function print_styles()
        {
            if (empty(reboot_get_oembed_video_urls())) {
                return;
            }

            ?>
            <style>
                .o-responsive-embed {
                    position: relative;
                    padding-bottom: 56.25%;
                    height: 0;
                    overflow: hidden;

                    margin-top: 30px;
                    margin-bottom: 30px;
                }

                .o-responsive-embed:first-child {
                    margin-top: 0;
                }

                .o-responsive-embed:last-child {
                    margin-bottom: 0;
                }

                .o-responsive-embed iframe, .o-responsive-embed object, .o-responsive-embed embed, .o-responsive-embed video {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                }
            </style>
            <?php
        }
    }

    new reboot_responsive_embed_for_wp_videos();

}

