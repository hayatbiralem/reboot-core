<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s Social Sharer", REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints social sharer links', REBOOT_TEXT_DOMAIN),
    "icon" => "icon-agency",
    "base" => "reboot_social_sharer",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

        array(
            "type" => "checkbox",
            "heading" => __("Platforms?", REBOOT_TEXT_DOMAIN),
            "param_name" => "platforms",
            "value" => array(
                __('Facebook', REBOOT_TEXT_DOMAIN) => 'facebook',
                __('Twitter', REBOOT_TEXT_DOMAIN) => 'twitter',
                __('Linkedin', REBOOT_TEXT_DOMAIN) => 'linkedin',
            ),
        ),

    ),
);