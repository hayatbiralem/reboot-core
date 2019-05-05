<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s Post List", REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Simple post list from any post type with optional taxonomy terms', REBOOT_CORE_TEXT_DOMAIN),
    "icon" => "icon-post-list",
    "base" => "reboot_post_list",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Post Type", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "post_type",
            "value" => "post",
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Count", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "count",
            "value" => "5",
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Taxonomy", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "taxonomy",
            "value" => "",
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Terms", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "terms",
            "value" => "",
        ),

    ),
);