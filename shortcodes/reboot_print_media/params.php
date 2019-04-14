<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

$folders = [];
if(function_exists('wp_rml_objects')) {
    $objects = wp_rml_objects();
    foreach ($objects as $object) {
        /** @var MatthiasWeb\RealMediaLibrary\folder\Folder $object */
        $data = $object->getRowData();
        $folders[$data->name] = $data->id;
    }
} else {
    $folders = [
        __('No folder found', REBOOT_TEXT_DOMAIN) => ''
    ];
}

return array(
    "name" => sprintf( __("%s Media List", REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints media list with given folder', REBOOT_TEXT_DOMAIN),
    "icon" => "icon-agency",
    "base" => "reboot_print_media",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(

        /**
         * General
         */

//        array(
//            'type' => 'dropdown',
//            'heading' => __('Type', REBOOT_TEXT_DOMAIN),
//            'value' => [
//                __('Standard', REBOOT_TEXT_DOMAIN) => 'standard',
//            ],
//            'std' => '',
//            'admin_label' => true,
//            'param_name' => 'type',
//            'description' => __('Select type.', REBOOT_TEXT_DOMAIN),
//        ),

        array(
            'type' => 'dropdown',
            'heading' => __('Folder', REBOOT_TEXT_DOMAIN),
            'value' => $folders,
            'std' => '',
            'admin_label' => true,
            'param_name' => 'folder',
            'description' => __('Select folder.', REBOOT_TEXT_DOMAIN),
        ),

        array(
            'type' => 'checkbox',
            'heading' => __( 'Add description column?', REBOOT_TEXT_DOMAIN ),
            'param_name' => 'add_description_column',
            'group' => __('Additional Settings', REBOOT_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textarea_raw_html',
            'holder' => 'div',
            'heading' => __( 'Action Content', REBOOT_TEXT_DOMAIN ),
            'param_name' => 'action_content',
            'description' => sprintf(__( '<p>You can use shortcodes and/or html here! Leave empty to use default: "%s"</p>', REBOOT_TEXT_DOMAIN ), __('Show', REBOOT_TEXT_DOMAIN)),
            'group' => __('Additional Settings', REBOOT_TEXT_DOMAIN),
        )

    ),
);