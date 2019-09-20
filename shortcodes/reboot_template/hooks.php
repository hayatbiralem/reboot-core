<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

/**
 * Ultimate Addons Style Fix
 */

add_action('ultimate_front_scripts_post_content', function($post_content, $post){

    if(has_shortcode($post_content, 'reboot_template')) {
        $shortcodes = reboot_parse_self_closing_shortcodes(['reboot_template'], $post_content);
        if(!empty($shortcodes)) {
            $replace = [];
            foreach ($shortcodes as $shortcode) {
                if(!isset($replace[$shortcode['full_match']])) {
                    if(isset($shortcode['params']['id']) && !empty($shortcode['params']['id'])) {
                        $block = get_post($shortcode['params']['id']);
                        if($block) {
                            $replace[$shortcode['full_match']] = $block->post_content;
                        }
                    }
                }
            }
            if(!empty($replace)) {
                $post_content = str_replace(
                    array_keys($replace),
                    array_values($replace),
                    $post_content
                );
            }
        }
    }

    return $post_content;
}, 10, 2);