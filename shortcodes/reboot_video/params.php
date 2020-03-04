<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s Video", REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('HTML5 Video', REBOOT_CORE_TEXT_DOMAIN),
    "icon" => "icon-video",
    "base" => "reboot_video",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Source", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "src",
            "value" => "",
            "description" => __("Paste MP4 or OGV or WEBM video url", REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("MP4", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "mp4",
            "value" => "",
            "description" => __("Paste MP4 video url", REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("OGV", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "ogv",
            "value" => "",
            "description" => __("Paste OGV video url", REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("WEBM", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "webm",
            "value" => "",
            "description" => __("Paste WEBM video url", REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Poster", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "poster",
            "value" => "",
            "description" => __("Paste poster image url", REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Width", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "width",
            "value" => "1600",
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Height", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "height",
            "value" => "900",
        ),

        array(
            "type" => "checkbox",
            "heading" => __("Features", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "features",
            "value" => array(
                __('Muted', REBOOT_CORE_TEXT_DOMAIN) => 'muted',
                __('Controls', REBOOT_CORE_TEXT_DOMAIN) => 'controls',
                __('Loop', REBOOT_CORE_TEXT_DOMAIN) => 'loop',
                __('Auto play', REBOOT_CORE_TEXT_DOMAIN) => 'autoplay',
                // __('Plays inline', REBOOT_CORE_TEXT_DOMAIN) => 'playsinline',
            ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('Preload', REBOOT_CORE_TEXT_DOMAIN),
            'value' => [
                __('Auto') => '',
                __('Metadata') => 'metadata',
                __('None') => 'none',
            ],
            'std' => '',
            'param_name' => 'preload',
        ),

    ),
);