<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!class_exists('reboot_video_shortcode_improvements')) {

    class reboot_video_shortcode_improvements{

        function __construct()
        {
            add_filter('do_shortcode_tag', [$this, 'filter_output'], 10, 4);
        }

        function filter_output( $output, $tag, $attr, $m ){
            if($tag != 'video') {
                return $output;
            }

//            $output .= '<!-- video:debug: '. var_export($attr, true) .' -->';
//            $output .= '<!-- video:debug: '. var_export($m, true) .' -->';

            $replace = [];

            $replace['class="wp-video-shortcode"'] = 'class="wp-video-shortcode" playsinline="playsinline"';

            $output = str_replace(
                array_keys($replace),
                array_values($replace),
                $output
            );

            if(isset($attr['muted']) && !empty($attr['muted']) && $attr['muted']) {
                $replace = [];
                $replace['class="wp-video-shortcode"'] = 'class="wp-video-shortcode" muted="muted"';

                $output = str_replace(
                    array_keys($replace),
                    array_values($replace),
                    $output
                );
            }

            if(isset($attr['controls']) && !empty($attr['controls']) && $attr['controls'] == 'off') {
                $replace = [];
                $replace['class="wp-video"'] = 'class="wp-video wp-video--hide-controls"';
                $replace[' controls="controls"'] = '';

                $output = str_replace(
                    array_keys($replace),
                    array_values($replace),
                    $output
                );
            }

            return $output;
        }

    }

    new reboot_video_shortcode_improvements();

}

