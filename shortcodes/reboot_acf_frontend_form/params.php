<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s ACF Front End Form", REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints an ACF form for front-end', REBOOT_TEXT_DOMAIN),
    "icon" => "icon-acf-frontend-form",
    "base" => "reboot_acf_frontend_form",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

        array(
            'type' => 'dropdown',
            'heading' => __('Block', REBOOT_TEXT_DOMAIN),
            'value' => reboot_get_post_ids('acf-field-group'),
            'std' => '',
            'admin_label' => true,
            'param_name' => 'id',
            'description' => __('Select ACF form.', REBOOT_TEXT_DOMAIN),
        ),

    ),
);