<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf(esc_html__("%s Empty Space", REBOOT_CHILD_TEXT_DOMAIN), REBOOT_AGENCY),
    "description" => esc_html__('Prints responsive space.', REBOOT_CHILD_TEXT_DOMAIN),
    "icon" => "icon-reboot_space",
    "base" => "reboot_space",
    "class" => "",
    "category" => sprintf(esc_html__('%s Elements', REBOOT_CHILD_TEXT_DOMAIN), REBOOT_AGENCY),
    "params" => array(

        array(
            'type' => 'dropdown',
            'param_name' => 'size',
            'value' => array(
                esc_html__('Small', REBOOT_CHILD_TEXT_DOMAIN) => 'small',
                esc_html__('Medium', REBOOT_CHILD_TEXT_DOMAIN) => 'medium',
                esc_html__('Large', REBOOT_CHILD_TEXT_DOMAIN) => 'large',
                esc_html__('Huge', REBOOT_CHILD_TEXT_DOMAIN) => 'huge',
                esc_html__('Custom', REBOOT_CHILD_TEXT_DOMAIN) => 'custom',
            ),
            'std' => 'small',
            'heading' => esc_html__('Size', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Select predefined responsive spacing size or custom to define yours.', REBOOT_CHILD_TEXT_DOMAIN),
            'admin_label' => true,
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Mobile", REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('CSS units are allowed.', REBOOT_CHILD_TEXT_DOMAIN),
            "param_name" => "mobile",
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'size',
                'value' => array('custom'),
            ),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Desktop (optional)", REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Leave empty to use mobile space at desktop too.', REBOOT_CHILD_TEXT_DOMAIN),
            "param_name" => "desktop",
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'size',
                'value' => array('custom'),
            ),
        ),

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