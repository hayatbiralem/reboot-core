<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf(esc_html__("%s Buttons", REBOOT_CHILD_TEXT_DOMAIN), REBOOT_AGENCY),
    "description" => esc_html__('Prints one or more.', REBOOT_CHILD_TEXT_DOMAIN),
    "icon" => "icon-reboot_buttons",
    "base" => "reboot_buttons",
    "class" => "",
    "category" => sprintf(esc_html__('%s Elements', REBOOT_CHILD_TEXT_DOMAIN), REBOOT_AGENCY),
    "params" => array(

        array(
            'type' => 'dropdown',
            'param_name' => 'align',
            'value' => array(
                esc_html__('None', REBOOT_CHILD_TEXT_DOMAIN) => '',
                esc_html__('Left', REBOOT_CHILD_TEXT_DOMAIN) => 'left',
                esc_html__('Center', REBOOT_CHILD_TEXT_DOMAIN) => 'center',
                esc_html__('Right', REBOOT_CHILD_TEXT_DOMAIN) => 'right',
            ),
            'std' => '',
            'heading' => esc_html__('Align', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Select button(s) align.', REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'heading'     => __( 'Size', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name'  => 'size',
            'type'        => 'dropdown',
            'value'       => array(
                'Small'  => 's',
                'Medium' => 'm',
                'Large'  => 'l',
            ),
            'std' => 'm',
            'description' => __( 'Small, medium & large buttons be set up in Theme Options / Buttons.', REBOOT_CHILD_TEXT_DOMAIN ),
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Full Width', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'full_width',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'action',
            'value' => array(
                __('One button', REBOOT_CHILD_TEXT_DOMAIN) => 'one_button',
                __('Two buttons', REBOOT_CHILD_TEXT_DOMAIN) => 'two_buttons',
            ),
            'std' => 'one_button',
            'heading' => esc_html__('Action', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('You can add some links.', REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Button #1', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'button_1',
            'edit_field_class' => 'vc_col-sm-6',
        ),

        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Button #2', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'button_2',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'action',
                'value' => array('two_buttons'),
            ),
        ),

        /**
         * Mobile Behavior
         */

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Mobile Full Width', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'mobile_full_width',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            "group" => esc_html__("Mobile Behavior", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        /**
         * Visibility
         */

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Hide on Mobile', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'hide_on_mobile',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            "group" => esc_html__("Visibility", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Hide on Desktop', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'hide_on_desktop',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            "group" => esc_html__("Visibility", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        /**
         * Advanced
         */

        array(
            "type" => "textfield",
            "heading" => esc_html__("Element ID", REBOOT_CHILD_TEXT_DOMAIN),
            "param_name" => "el_id",
            "group" => esc_html__("Advanced", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Element Classes", REBOOT_CHILD_TEXT_DOMAIN),
            "param_name" => "el_class",
            "group" => esc_html__("Advanced", REBOOT_CHILD_TEXT_DOMAIN),
        ),

    ),
);