<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

add_action('get_header', function(){

    $post_id = null;

    // The7 Custom Block Compatibility
    if(function_exists('presscore_get_config')) {
        $config = presscore_config();
        $post_id = $config->get('post_id');

        if(empty($post_id)) {

        }
    }

    if(empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }

    if(empty($post_id)) {
        return;
    }

    $entry = get_post($post_id);

    if(empty($entry)) {
        return;
    }

    if(!has_shortcode($entry->post_content, 'reboot_acf_frontend_form')) {
        return;
    }

    acf_form_head();
});