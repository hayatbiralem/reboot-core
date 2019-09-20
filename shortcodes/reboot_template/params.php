<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

$params = [];

if(!defined('REBOOT_CORE_DISABLE_BLOCKS') || !REBOOT_CORE_DISABLE_BLOCKS) {
    $params = array(

        /**
         * General
         */

        array(
            'type' => 'dropdown',
            'heading' => __('Block', REBOOT_CORE_TEXT_DOMAIN),
            'value' => reboot_get_post_ids('block'),
            'std' => '',
            'admin_label' => true,
            'param_name' => 'id',
            'description' => __('Select block.', REBOOT_CORE_TEXT_DOMAIN),
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Disable wrapper', REBOOT_CORE_TEXT_DOMAIN ),
            'param_name' => 'disable_wrapper',
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Condition", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "condition",
            "value" => "",
            "description" => __("You can set some condition here like <code>{call:function_name}</code> or <code>{call:class_name->method_name}</code>. <br>You can send params like <code>{call:function_name(Param 1, Param 2)}</code>", REBOOT_CORE_TEXT_DOMAIN),
            'group' => sprintf(__('%s Condition', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
        ),

    );
}

return array(
    "name" => sprintf( __("%s Template", REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints custom block template', REBOOT_CORE_TEXT_DOMAIN),
    "icon" => "icon-template",
    "base" => "reboot_template",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => $params,
);