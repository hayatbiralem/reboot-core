<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

add_action('get_header', function(){
    global $post;

    if(!$post) {
        return;
    }

    if(!has_shortcode($post->post_content, 'reboot_acf_frontend_form')) {
        return;
    }

    acf_form_head();
});