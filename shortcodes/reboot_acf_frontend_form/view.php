<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

acf_form([
    'post_id' => 'new_post',
    'new_post'		=> array(
        'post_type'		=> 'booking',
        'post_status'		=> 'publish'
    ),
    'updated_message' => false,
    'field_groups' => [$id],
    'submit_value' => $submit_value ?: __("Update", REBOOT_TEXT_DOMAIN),
    'html_submit_button'	=> '<button type="submit" class="default-btn-shortcode dt-btn dt-btn-m"><span>%s</span></button>',
]);