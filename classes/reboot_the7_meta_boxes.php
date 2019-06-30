<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!class_exists('reboot_the7_meta_boxes')) {

    class reboot_the7_meta_boxes {

        function __construct()
        {
            add_filter('presscore_pages_with_basic_meta_boxes', [$this, 'presscore_pages_with_basic_meta_boxes'], 10, 1);
            add_action('the7_before_meta_box_registration', [$this, 'the7_before_meta_box_registration']);
        }

        function presscore_pages_with_basic_meta_boxes( $post_types ){
            $post_types = self::add_default_post_types_to_array($post_types);
            return apply_filters( 'reboot_the7_meta_boxes_basic', $post_types );
        }

        function the7_before_meta_box_registration(){
            global $DT_META_BOXES;

            if(is_array($DT_META_BOXES) && isset($DT_META_BOXES['dt_page_box-post_options'])) {
                $pages = self::add_default_post_types_to_array($DT_META_BOXES['dt_page_box-post_options']['pages']);
                $DT_META_BOXES['dt_page_box-post_options']['pages'] = apply_filters('reboot_the7_meta_boxes_post', $pages);
            }
        }

        static function add_default_post_types_to_array($post_types){
            if(!is_array($post_types)) {
                $post_types = [];
            }

            $post_types = array_merge($post_types, ['block']);

            return apply_filters('reboot_the7_meta_boxes_default', $post_types);
        }

    }

    new reboot_the7_meta_boxes();

}

