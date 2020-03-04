<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}
if (!class_exists('reboot_additional_user_settings')) {

    class reboot_additional_user_settings
    {

        function __construct()
        {
            add_action('acf/init', [$this, 'add_additional_user_settings']);
            add_filter('pre_get_avatar_data', [$this, 'get_avatar'], 2, 99);
        }

        public function add_additional_user_settings()
        {
            if( function_exists('acf_add_local_field_group') ):

                $fields = array(
                    array(
                        'key' => 'field_5d6ec7bcbfb4d',
                        'label' => __('Custom Profile Picture (Avatar)', REBOOT_CORE_TEXT_DOMAIN),
                        'name' => 'custom_avatar',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'id',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                );

                $fields = apply_filters('reboot_additional_user_settings', $fields);

                acf_add_local_field_group(array(
                    'key' => 'group_5d6ec7b2a165b',
                    'title' => __('Additional Settings'),
                    'fields' => $fields,
                    'location' => array(
                        array(
                            array(
                                'param' => 'user_form',
                                'operator' => '==',
                                'value' => 'all',
                            ),
                        ),
                    ),
                    'menu_order' => 0,
                    'position' => 'normal',
                    'style' => 'default',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen' => '',
                    'active' => true,
                    'description' => '',
                ));

            endif;
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

    new reboot_additional_user_settings();

}

