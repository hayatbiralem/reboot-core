<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s The Content", REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints post content', REBOOT_CORE_TEXT_DOMAIN),
    "icon" => "icon-the-content",
    "base" => "reboot_the_content",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

        array(
            'type' => 'checkbox',
            'heading' => __( 'Disable auto paragraphs', REBOOT_CORE_TEXT_DOMAIN ),
            'param_name' => 'disable_autop',
        ),

    ),
);