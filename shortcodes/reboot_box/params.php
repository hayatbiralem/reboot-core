<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

return array(
    "name" => sprintf(esc_html__("%s Box", REBOOT_CHILD_TEXT_DOMAIN), REBOOT_AGENCY),
    "description" => esc_html__('Prints content and/or responsive image with predefined skins and optional actions', REBOOT_CHILD_TEXT_DOMAIN),
    "icon" => "icon-reboot_box",
    "base" => "reboot_box",
    "class" => "",
    "category" => sprintf(esc_html__('%s Elements', REBOOT_CHILD_TEXT_DOMAIN), REBOOT_AGENCY),
    "params" => array(

        array(
            'type' => 'dropdown',
            'param_name' => 'style',
            'value' => array(
                esc_html__('None', REBOOT_CHILD_TEXT_DOMAIN) => '',
                esc_html__('Section Title', REBOOT_CHILD_TEXT_DOMAIN) => 'section-title',
                esc_html__('Classic', REBOOT_CHILD_TEXT_DOMAIN) => 'classic',
                esc_html__('Hero', REBOOT_CHILD_TEXT_DOMAIN) => 'hero',
            ),
            'std' => '',
            'heading' => esc_html__('Style', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Select box display style.', REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'color',
            'value' => array(
                esc_html__('Dark', REBOOT_CHILD_TEXT_DOMAIN) => 'dark',
                esc_html__('Light', REBOOT_CHILD_TEXT_DOMAIN) => 'light',
            ),
            'std' => 'dark',
            'heading' => esc_html__('Color', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Select color theme.', REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Height', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'height',
            'value' => '',
            'description' => esc_html__( 'Enter max height for hero box. Leave empty to auto height. CSS units are allowed.', REBOOT_CHILD_TEXT_DOMAIN ),
            'dependency' => array(
                'element' => 'style',
                'value' => array('hero'),
            ),
            "group" => esc_html__("Hero Settings", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Mobile Ratio', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'mobile_ratio',
            'value' => '',
            'description' => esc_html__( 'Enter ratio like 16:9, 4:3, 1:1 etc. such as {width}:{height} Leave empty to use the height.', REBOOT_CHILD_TEXT_DOMAIN ),
            'dependency' => array(
                'element' => 'style',
                'value' => array('hero'),
            ),
            "group" => esc_html__("Hero Settings", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'checkbox',
            'param_name' => 'enable_mobile_overlap',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            'heading' => esc_html__('Enable Mobile Overlap?', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Check this to send content to image below and set color to dark.', REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'style',
                'value' => array('hero'),
            ),
            "group" => esc_html__("Hero Settings", REBOOT_CHILD_TEXT_DOMAIN),
        ),


        /**
         * Content
         */

        array(
            'type' => 'dropdown',
            'param_name' => 'align',
            'value' => array(
                esc_html__('None', REBOOT_CHILD_TEXT_DOMAIN) => '',
                esc_html__('Left', REBOOT_CHILD_TEXT_DOMAIN) => 'left',
                esc_html__('Center', REBOOT_CHILD_TEXT_DOMAIN) => 'center',
                esc_html__('Right', REBOOT_CHILD_TEXT_DOMAIN) => 'right',
            ),
            'std' => '',
            'heading' => esc_html__('Align', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Select text align.', REBOOT_CHILD_TEXT_DOMAIN),
            'edit_field_class' => 'vc_col-sm-6',
            "group" => esc_html__("Content", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Content Width', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'content_width',
            'description' => esc_html__( 'You can limit the content area width. CSS units are allowed.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-6',
            "group" => esc_html__("Content", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textarea_html',
            'holder' => 'div',
            'heading' => esc_html__('Content', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'content',
            "group" => esc_html__("Content", REBOOT_CHILD_TEXT_DOMAIN),
        ),


        /**
         * Dynamic Content
         */

        array(
            'type' => 'checkbox',
            'param_name' => 'dynamic_content_enabled',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            'heading' => esc_html__('Enable Dynamic Content?', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Check this to select any post type as additional content source.', REBOOT_CHILD_TEXT_DOMAIN),
            "group" => esc_html__("Dynamic Content", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'autocomplete',
            'heading' => esc_html__('Entry ID', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'entry_id',
            'description' => esc_html__('Select post, page, product, etc. by title to fetch title and excerpt as content.', REBOOT_CHILD_TEXT_DOMAIN),
            'settings' => array(
                // 'multiple' => true,
                // 'unique_values' => true,

                // 'multiple' => true,
                // 'sortable' => true,
                'groups' => true,
            ),
            "group" => esc_html__("Dynamic Content", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'dynamic_content_enabled',
                'value' => array('yes'),
            ),
        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'heading_tag',
            'value' => array(
                __('Disable (Hide Title)', REBOOT_CHILD_TEXT_DOMAIN) => '',
                __('H1', REBOOT_CHILD_TEXT_DOMAIN) => 'h1',
                __('H2', REBOOT_CHILD_TEXT_DOMAIN) => 'h2',
                __('H3', REBOOT_CHILD_TEXT_DOMAIN) => 'h3',
                __('H4', REBOOT_CHILD_TEXT_DOMAIN) => 'h4',
                __('H5', REBOOT_CHILD_TEXT_DOMAIN) => 'h5',
                __('H6', REBOOT_CHILD_TEXT_DOMAIN) => 'h6',
                __('div', REBOOT_CHILD_TEXT_DOMAIN) => 'div',
                __('p', REBOOT_CHILD_TEXT_DOMAIN) => 'p',
                __('span', REBOOT_CHILD_TEXT_DOMAIN) => 'span',
            ),
            'std' => 'h3',
            'heading' => esc_html__('Title', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Select HTML tag for dynamic heading.', REBOOT_CHILD_TEXT_DOMAIN),
            "group" => esc_html__("Dynamic Content", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'dynamic_content_enabled',
                'value' => array('yes'),
            ),
        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'content_source',
            'value' => array(
                __('Disable (Hide Content)', REBOOT_CHILD_TEXT_DOMAIN) => '',
                __('Excerpt', REBOOT_CHILD_TEXT_DOMAIN) => 'excerpt',
                __('Full Content', REBOOT_CHILD_TEXT_DOMAIN) => 'content',
            ),
            'std' => 'excerpt',
            'heading' => esc_html__('Content', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Select content source from entry.', REBOOT_CHILD_TEXT_DOMAIN),
            "group" => esc_html__("Dynamic Content", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'dynamic_content_enabled',
                'value' => array('yes'),
            ),
        ),


        /**
         * Images
         */

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use featured image', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'use_featured_image',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            'description' => esc_html__( 'You enabled Dynamic Content so if you check this we can try to use the featured image of that selected entry and the Desktop Image will be used as fallback.', REBOOT_CHILD_TEXT_DOMAIN ),
            "group" => esc_html__("Images", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'dynamic_content_enabled',
                'value' => array('yes'),
            ),
        ),

        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Image', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'image',
            'description' => esc_html__('Select image from media library. You need to think mobile first!', REBOOT_CHILD_TEXT_DOMAIN),
            'edit_field_class' => 'vc_col-sm-4',
            "group" => esc_html__("Images", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image Size', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'image_size',
            'value' => 'full',
            'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
            "group" => esc_html__("Images", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image Ratio', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'image_ratio',
            'value' => '',
            'description' => esc_html__( 'Enter ratio like 16:9, 4:3, 1:1 etc. such as {width}:{height} Leave empty to use default dimensions.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
            "group" => esc_html__("Images", REBOOT_CHILD_TEXT_DOMAIN),
        ),


        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Desktop Image (Optional)', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'desktop_image',
            'description' => esc_html__('You can change image when device viewport is greater than 768px. Leave empty to use the Mobile Image for desktop too.', REBOOT_CHILD_TEXT_DOMAIN),
            'edit_field_class' => 'vc_col-sm-4',
            "group" => esc_html__("Images", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Desktop Image Size', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'desktop_image_size',
            'value' => 'full',
            'description' => esc_html__( 'Enter desktop image image size, if the Desktop Image is set. Leave empty to use "full" size.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
            "group" => esc_html__("Images", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Desktop Image Ratio', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'desktop_image_ratio',
            'value' => '',
            'description' => esc_html__( 'Enter ratio like 16:9, 4:3, 1:1 etc. such as {width}:{height} Leave empty to use default dimensions.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
            "group" => esc_html__("Images", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Image Overlay', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'overlay_color',
            'description' => esc_html__( 'Select image overlay color.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-4',
            "group" => esc_html__("Image Overlay", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Overlay Gradient', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'overlay_gradient',
            'value' => '',
            'description' => esc_html__( 'You can use css like: "background: linear-gradient(220deg, rgba(0,0,0,0.1) 16%, rgba(0,0,0,0.5) 100%);". You can use https://www.colorzilla.com/gradient-editor/', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-8',
            "group" => esc_html__("Image Overlay", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        /**
         * Icon
         */

        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'icon',
            'value' => '',
            // default value to backend editor admin_label
            'settings' => array(
                "type" => "the7_icons",
                'emptyIcon' => true,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'description' => __( 'Select icon from library.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-6',
            "group" => esc_html__("Icon", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon Size', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'icon_size',
            'description' => esc_html__( 'As font size. CSS units are allowed.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-6',
            "group" => esc_html__("Icon", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Position', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-6',
            'param_name' => 'icon_position',
            'value' => array(
                __('Top', REBOOT_CHILD_TEXT_DOMAIN) => '',
                __('Left', REBOOT_CHILD_TEXT_DOMAIN) => 'left',
            ),
            'std' => '',
            "group" => esc_html__("Icon", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Style', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-6',
            'param_name' => 'icon_style',
            'value' => array(
                __('None', REBOOT_CHILD_TEXT_DOMAIN) => '',
                __('Fancy', REBOOT_CHILD_TEXT_DOMAIN) => 'fancy',
                __('Circle Background', REBOOT_CHILD_TEXT_DOMAIN) => 'circle',
            ),
            'std' => '',
            "group" => esc_html__("Icon", REBOOT_CHILD_TEXT_DOMAIN),
        ),

//        array(
//            'type' => 'gradient',
//            'heading' => esc_html__( 'Overlay Gradient', REBOOT_CHILD_TEXT_DOMAIN ),
//            'param_name' => 'overlay_gradient',
//            'edit_field_class' => 'vc_col-sm-6',
//            "group" => esc_html__("Image Overlay", REBOOT_CHILD_TEXT_DOMAIN),
//            'dependency' => array(
//                'element' => 'use_overlay_gradient',
//                'value' => array('yes'),
//            ),
//        ),

        array(
            'type' => 'dropdown',
            'param_name' => 'action',
            'value' => array(
                __('Disabled', REBOOT_CHILD_TEXT_DOMAIN) => '',
                __('Whole box', REBOOT_CHILD_TEXT_DOMAIN) => 'box',
                __('One button', REBOOT_CHILD_TEXT_DOMAIN) => 'one_button',
                __('Two buttons', REBOOT_CHILD_TEXT_DOMAIN) => 'two_buttons',
            ),
            'std' => '',
            'heading' => esc_html__('Action', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('You can add some links.', REBOOT_CHILD_TEXT_DOMAIN),
            "group" => esc_html__("Action", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Box Link', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'link',
            "group" => esc_html__("Action", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'action',
                'value' => array('box'),
            ),
        ),

        array(
            'heading'     => __( 'Button Size', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name'  => 'button_size',
            'type'        => 'dropdown',
            'value'       => array(
                'Small'  => 's',
                'Medium' => 'm',
                'Large'  => 'l',
            ),
            'std' => 'm',
            'description' => __( 'Small, medium & large buttons be set up in Theme Options / Buttons.', REBOOT_CHILD_TEXT_DOMAIN ),
            "group" => esc_html__("Action", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'action',
                'value' => array('one_button', 'two_buttons'),
            ),
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Full Width', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'button_full_width',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            "group" => esc_html__("Action", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'action',
                'value' => array('one_button', 'two_buttons'),
            ),
        ),

        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Button #1', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'button_1',
            "group" => esc_html__("Action", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'action',
                'value' => array('one_button', 'two_buttons'),
            ),
        ),

        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Button #2', REBOOT_CHILD_TEXT_DOMAIN),
            'param_name' => 'button_2',
            "group" => esc_html__("Action", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'action',
                'value' => array('two_buttons'),
            ),
        ),

        /**
         * Mobile Behavior
         */

        array(
            'type' => 'dropdown',
            'param_name' => 'mobile_align',
            'value' => array(
                esc_html__('None', REBOOT_CHILD_TEXT_DOMAIN) => '',
                esc_html__('Left', REBOOT_CHILD_TEXT_DOMAIN) => 'left',
                esc_html__('Center', REBOOT_CHILD_TEXT_DOMAIN) => 'center',
                esc_html__('Right', REBOOT_CHILD_TEXT_DOMAIN) => 'right',
            ),
            'std' => '',
            'heading' => esc_html__('Mobile Align', REBOOT_CHILD_TEXT_DOMAIN),
            'description' => esc_html__('Select text align for mobile.', REBOOT_CHILD_TEXT_DOMAIN),
            'edit_field_class' => 'vc_col-sm-6',
            "group" => esc_html__("Mobile Behavior", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Mobile Content Width', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'content_content_width',
            'description' => esc_html__( 'You can limit the mobile content area width. CSS units are allowed. Set auto to disable desktop setting.', REBOOT_CHILD_TEXT_DOMAIN ),
            'edit_field_class' => 'vc_col-sm-6',
            "group" => esc_html__("Mobile Behavior", REBOOT_CHILD_TEXT_DOMAIN),
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Mobile Buttons Full Width', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'mobile_button_full_width',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            "group" => esc_html__("Mobile Behavior", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'action',
                'value' => array('one_button', 'two_buttons'),
            ),
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Hide Button #1', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'mobile_hide_button_1',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            "group" => esc_html__("Mobile Behavior", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'action',
                'value' => array('one_button', 'two_buttons'),
            ),
        ),

        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Hide Button #2', REBOOT_CHILD_TEXT_DOMAIN ),
            'param_name' => 'mobile_hide_button_2',
            'value' => array( esc_html__( 'Yes', REBOOT_CHILD_TEXT_DOMAIN ) => 'yes' ),
            "group" => esc_html__("Mobile Behavior", REBOOT_CHILD_TEXT_DOMAIN),
            'dependency' => array(
                'element' => 'action',
                'value' => array('two_buttons'),
            ),
        ),


        /**
         * Advanced
         */

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


    ),
);