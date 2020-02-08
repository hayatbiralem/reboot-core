<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

$args = [
    'post_id' => 'new_post',
    'post_title' => $post_title ?: false,
    'new_post'		=> array(
        'post_type'		=> $post_type ?: 'post',
        'post_status'		=> 'publish'
    ),
    'updated_message' => false,
    'field_groups' => explode(',', $id),
    'submit_value' => $submit_value ?: __("Update", REBOOT_CORE_TEXT_DOMAIN),
    'html_submit_button'	=> '<button type="submit" class="default-btn-shortcode dt-btn dt-btn-m"><span>%s</span></button>',
];

if(isset($post_id) && !empty($post_id)) {
    if($post_id == 'current') {
        $args['post_id'] = get_the_ID();
    } else {
        $args['post_id'] = $post_id;
    }
}

if(!empty($redirect)) {
    if(is_numeric($redirect)) {
        $return = get_permalink($redirect);
    } else {
        $return = $redirect;
    }

    if($return) {
        $args['return'] = $return;
    }
}

acf_form($args);