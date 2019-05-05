<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

$args = [
    'post_id' => 'new_post',
    'post_title' => true,
    'new_post'		=> array(
        'post_type'		=> 'booking',
        'post_status'		=> 'publish'
    ),
    'updated_message' => false,
    'field_groups' => [$id],
    'submit_value' => $submit_value ?: __("Update", REBOOT_CORE_TEXT_DOMAIN),
    'html_submit_button'	=> '<button type="submit" class="default-btn-shortcode dt-btn dt-btn-m"><span>%s</span></button>',
];

if(!empty($redirect)) {
    $url = get_permalink($redirect);
    if($url) {
        $args['return'] = $url;
    }
}

acf_form($args);