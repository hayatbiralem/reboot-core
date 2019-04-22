<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s Shortcode", REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints shortcode output without extra wrapper, etc.', REBOOT_TEXT_DOMAIN),
    "icon" => "icon-agency",
    "base" => "reboot_shortcode",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

        array(
            'type' => 'textarea_raw_html',
            'holder' => 'div',
            'heading' => __( 'Shortcode', REBOOT_TEXT_DOMAIN ),
            'param_name' => 'shortcode',
            'value' => __( '<p>You can use shortcodes here!</p>', REBOOT_TEXT_DOMAIN ),
        ),

    ),
);