<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_filter_get_avatar')) {

    class reboot_filter_get_avatar
    {

        function __construct()
        {
            add_filter('pre_get_avatar_data', [$this, 'get_avatar'], 2, 99);
        }

        public function get_avatar($args, $id_or_email)
        {
            if(!function_exists('get_field')) {
                return $args;
            }

            if(!is_numeric($id_or_email)) {
                $user = get_user_by('email', $id_or_email);
                $user_id = $user->ID;
            } else {
                $user_id = $id_or_email;
            }

            $custom_avatar = get_field('custom_avatar', 'user_' . $user_id);
            if(!empty($custom_avatar)) {
                // $args['url'] = wp_get_attachment_image_url($custom_avatar, [$args['size'], $args['size']]);
                $args['url'] = wp_get_attachment_image_url($custom_avatar, 'thumbnail');
            }

            return $args;
        }

    }

    new reboot_filter_get_avatar();

}
