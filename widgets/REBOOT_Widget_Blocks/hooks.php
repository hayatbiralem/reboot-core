<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('REBOOT_Widget_Blocks_Hooks')) {

    class REBOOT_Widget_Blocks_Hooks
    {

        function __construct()
        {
            add_action('acf/init', [$this, 'add_local_field_group']);
        }

        function add_local_field_group()
        {

            acf_add_local_field_group(array(
                'key' => 'group_5bcf6694df37f',
                'title' => 'Widget: Block',
                'fields' => array(
                    array(
                        'key' => 'field_5bcf669514f5b',
                        'label' => __('Blocks', REBOOT_TEXT_DOMAIN),
                        'name' => 'blocks',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => 'Add',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_reboot_widget_blocks',
                                'label' => __('Block', REBOOT_TEXT_DOMAIN),
                                'name' => 'id',
                                'type' => 'post_object',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'post_type' => array(
                                    0 => 'block',
                                ),
                                'taxonomy' => '',
                                'allow_null' => 1,
                                'multiple' => 0,
                                'return_format' => 'id',
                                'ui' => 1,
                            ),
                        ),
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'widget',
                            'operator' => '==',
                            'value' => 'reboot_widget_blocks',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            ));

        }
    }

    new REBOOT_Widget_Blocks_Hooks();

}
