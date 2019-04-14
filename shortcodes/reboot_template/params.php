<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf( __("%s Template", REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints custom block template', REBOOT_TEXT_DOMAIN),
    "icon" => "icon-template",
    "base" => "reboot_template",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

        array(
            'type' => 'dropdown',
            'heading' => __('Block', REBOOT_TEXT_DOMAIN),
            'value' => reboot_get_post_ids('block'),
            'std' => '',
            'admin_label' => true,
            'param_name' => 'id',
            'description' => __('Select block.', REBOOT_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Condition", REBOOT_TEXT_DOMAIN),
            "param_name" => "condition",
            "value" => "",
            "description" => __("You can set some condition here like <code>{call:function_name}</code> or <code>{call:class_name->method_name}</code>. <br>You can send params like <code>{call:function_name(Param 1, Param 2)}</code>", REBOOT_TEXT_DOMAIN),
            'group' => sprintf(__('%s Condition', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY),
        ),

    ),
);