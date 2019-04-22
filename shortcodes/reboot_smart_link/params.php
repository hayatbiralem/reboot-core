<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s Smart Link", REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints a link to wrap/overlay its parent', REBOOT_TEXT_DOMAIN),
    "icon" => "icon-agency",
    "base" => "reboot_smart_link",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

        array(
            'type' => 'dropdown',
            'heading' => __('Style', REBOOT_TEXT_DOMAIN),
            'value' => [
                __('Default') => 'default',
            ],
            'std' => 'default',
            'admin_label' => false,
            'param_name' => 'style',
        ),

        array(
            'type' => 'vc_link',
            'heading' => __( 'Link', REBOOT_TEXT_DOMAIN ),
            'param_name' => 'url',
        ),

        array(
            'type' => 'textfield',
            'heading' => __( 'Link Classes', REBOOT_TEXT_DOMAIN ),
            'param_name' => 'link_classes',
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Title", REBOOT_TEXT_DOMAIN),
            "param_name" => "title",
            "value" => "",
            'admin_label' => true,
        ),

        array(
            'type' => 'textarea_html',
            'holder' => 'div',
            'heading' => __( 'Description', REBOOT_TEXT_DOMAIN ),
            'param_name' => 'content',
            'description' => __( '<p>You can use html and/or shortcodes here!</p>', REBOOT_TEXT_DOMAIN ),
        ),

    ),
);