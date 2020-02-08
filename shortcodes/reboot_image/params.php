<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf(esc_html__("%s Image", REBOOT_CHILD_TEXT_DOMAIN), REBOOT_AGENCY),
    "description" => esc_html__('Prints responsive image with optional actions', REBOOT_CHILD_TEXT_DOMAIN),
    "icon" => "icon-reboot_image",
    "base" => "reboot_image",
    "class" => "",
    "category" => sprintf(esc_html__('%s Elements', REBOOT_CHILD_TEXT_DOMAIN), REBOOT_AGENCY),
    "params" => array(

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use featured image', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'use_featured_image',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            'description' => esc_html__( 'You can use the Featured Image and the Mobile Featured Image as images and following images will be used as fallback then.', REBOOT_CHILD_TEXT_DOMAIN ),
        ),

        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Image', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'image',
            'description' => esc_html__('Select image from media library. You need to think mobile first!', REBOOT_CHILD_TEXT_DOMAIN),
            'edit_field_class' => 'vc_col-sm-4',
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image Size', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'image_size',
            'value' => 'full',
            'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
            'admin_label' => true,
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image Ratio', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'image_ratio',
            'value' => '',
            'description' => esc_html__( 'Enter ratio like 16:9, 4:3, 1:1 etc. such as {width}:{height} Leave empty to use default dimensions.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
        ),

        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Desktop Image (Optional)', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'desktop_image',
            'description' => esc_html__('You can change image when device viewport >= 768px. Leave empty to use the Mobile Image for desktop too.', REBOOT_CHILD_TEXT_DOMAIN),
            'edit_field_class' => 'vc_col-sm-4',
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Desktop Image Size', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'desktop_image_size',
            'value' => 'full',
            'description' => esc_html__( 'Enter desktop image size, if the Desktop Image is set. Leave empty to use "full" size.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Desktop Image Ratio', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'desktop_image_ratio',
            'value' => '',
            'description' => esc_html__( 'Enter ratio like 16:9, 4:3, 1:1 etc. such as {width}:{height} Leave empty to use default dimensions.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
        ),

        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Link', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'link',
            'description' => esc_html__( 'You can link your image.', REBOOT_CHILD_TEXT_DOMAIN ),
            "group" => esc_html__("Action", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Element ID", REBOOT_CHILD_TEXT_DOMAIN),
            "param_name" => "el_id",
            "group" => esc_html__("Advanced", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Element Classes", REBOOT_CHILD_TEXT_DOMAIN),
            "param_name" => "el_class",
            "group" => esc_html__("Advanced", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Image Element Classes", REBOOT_CHILD_TEXT_DOMAIN),
            "param_name" => "image_class",
            "group" => esc_html__("Advanced", REBOOT_CHILD_TEXT_DOMAIN),
        ),

    ),
);