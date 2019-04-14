<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s Year", REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints current year', REBOOT_TEXT_DOMAIN),
    "icon" => "icon-year",
    "base" => "reboot_year",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(



        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Format", REBOOT_TEXT_DOMAIN),
            "param_name" => "format",
            "value" => "Y",
            "description" => __("More info: <a href='https://codex.wordpress.org/Formatting_Date_and_Time' target='_blank'>Formatting Date and Time</a>", REBOOT_TEXT_DOMAIN),
        ),

    ),
);