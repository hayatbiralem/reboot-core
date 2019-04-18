<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('REBOOT_Widget_Post_List_Hooks')) {

    class REBOOT_Widget_Post_List_Hooks
    {

        function __construct()
        {
            add_action('acf/init', [$this, 'add_local_field_group']);
        }

        function add_local_field_group()
        {

            if( function_exists('acf_add_local_field_group') ):

                acf_add_local_field_group(array(
                    'key' => 'group_5cadc6eea2908',
                    'title' => 'Post List Settings',
                    'fields' => array(
                        array(
                            'key' => 'field_5cadc88342b4b',
                            'label' => 'Data Settings',
                            'name' => 'reboot_post_list',
                            'type' => 'group',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'layout' => 'block',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_5cadc6fba2f15',
                                    'label' => 'Post Type',
                                    'name' => 'post_type',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'maxlength' => '',
                                ),
                                array(
                                    'key' => 'field_5cadc70da2f16',
                                    'label' => 'Count',
                                    'name' => 'count',
                                    'type' => 'text',
                                    'instructions' => 'Set -1 to list all',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'maxlength' => '',
                                ),
                                array(
                                    'key' => 'field_5cadc710a2f17',
                                    'label' => 'Taxonomy',
                                    'name' => 'taxonomy',
                                    'type' => 'text',
                                    'instructions' => 'Taxonomy slug',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'maxlength' => '',
                                ),
                                array(
                                    'key' => 'field_5cadc724a2f18',
                                    'label' => 'Terms',
                                    'name' => 'terms',
                                    'type' => 'text',
                                    'instructions' => 'Pipe (|) seperated terms list',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'maxlength' => '',
                                ),
                            ),
                        ),
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'widget',
                                'operator' => '==',
                                'value' => 'reboot_widget_post_list',
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
    }

    new REBOOT_Widget_Post_List_Hooks();

}
