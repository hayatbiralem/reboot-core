<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_override_post_names_with_acf_field')) {

    function reboot_override_post_names_with_acf_field($post_type = 'entry', $acf_field_name = 'name_surname', $request_param_to_check="reboot_override_post_names_with_acf_field")
    {
        if(isset($_REQUEST[$request_param_to_check])) {
            add_action('init', function () use ($post_type, $acf_field_name) {
                $items = get_posts([
                    'posts_per_page' => -1,
                    'post_type' => $post_type
                ]);

                if(!empty($items)) {
                    foreach ($items as $item) {
                        $new_post_title = get_field($acf_field_name, $item->ID);
                        wp_update_post([
                            'ID' => $item->ID,
                            'post_title' => $new_post_title,
                            'post_name' => sanitize_title($new_post_title),
                        ]);
                    }
                    die( sprintf('%s %s items updated!', count($items), $post_type) );
                } else {
                    die( sprintf('No %s items found!', $post_type) );
                }
            });
        }
    }

}