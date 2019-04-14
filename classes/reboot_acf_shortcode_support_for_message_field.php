<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

// Allow for shortcodes in messages
function reboot_acf_shortcode_support_for_message_field($field)
{

    if (empty($field['message']) || (is_admin() && (!function_exists('get_current_screen') || (get_current_screen())->post_type === "acf-field-group"))) {
        return $field;
    }

    $field['message'] = do_shortcode(reboot_replace_special_vars($field['message']));

    return $field;

}

add_filter('acf/load_field/type=message', 'reboot_acf_shortcode_support_for_message_field', 10);
