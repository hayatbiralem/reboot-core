<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_get_oembed_video_urls')) {

    function reboot_get_oembed_video_urls($content = '')
    {
        if (empty($content)) {
            global $post;
            $content = $post->post_content;
        }

        if (empty($content)) {
            return false;
        }

        // Here is a sample array of patterns for supported video embeds from wp-includes/class-wp-embed.php
        $pattern_array = array(
            '#https://youtu\.be/.*#i',
            '#https://(www\.)?youtube\.com/playlist.*#i',
            '#https://(www\.)?youtube\.com/watch.*#i',
            '#http://(www\.)?youtube\.com/watch.*#i',
            '#http://(www\.)?youtube\.com/playlist.*#i',
            '#http://youtu\.be/.*#i',
            '#https?://wordpress.tv/.*#i',
            '#https?://(.+\.)?vimeo\.com/.*#i'
        );

        $urls = [];
        foreach ($pattern_array as $pattern) {

            if (preg_match_all($pattern, $content, $matches)) {
                $urls[] = $matches[0];
            }

        }

        if (!empty($urls)) {
            return $urls;
        }

        return false;
    }

}