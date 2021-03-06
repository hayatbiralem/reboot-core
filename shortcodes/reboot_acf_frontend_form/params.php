<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s ACF Front End Form", REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints an ACF form for front-end', REBOOT_CORE_TEXT_DOMAIN),
    "icon" => "icon-acf-frontend-form",
    "base" => "reboot_acf_frontend_form",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

        array(
            'type' => 'textfield',
            'heading' => __('Post ID', REBOOT_CORE_TEXT_DOMAIN),
            'std' => '',
            'admin_label' => true,
            'param_name' => 'post_id',
            'description' => __('Set Post ID.', REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('Form ID', REBOOT_CORE_TEXT_DOMAIN),
            'value' => reboot_get_post_ids('acf-field-group'),
            'std' => '',
            'admin_label' => true,
            'param_name' => 'id',
            'description' => __('Select ACF form.', REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Post title?', REBOOT_CORE_TEXT_DOMAIN ),
            'param_name' => 'post_title',
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Post Type", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "post_type",
            "value" => "post",
            "std" => __("Update", REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Submit Value", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "submit_value",
            "value" => "",
            "std" => __("Update", REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('Success Page (Redirect)', REBOOT_CORE_TEXT_DOMAIN),
            'value' => array_merge(
                [
                    __('Select...', REBOOT_CORE_TEXT_DOMAIN) => '',
                ],
                reboot_get_post_ids('page')
            ),
            'std' => '',
            'admin_label' => true,
            'param_name' => 'redirect',
            'description' => __('Select page to redirect after success.', REBOOT_CORE_TEXT_DOMAIN),
        ),

    ),
);