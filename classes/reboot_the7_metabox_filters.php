<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!class_exists('reboot_the7_metabox_filters')) {

    class reboot_the7_metabox_filters{

        function __construct()
        {
            add_filter('presscore_pages_with_basic_meta_boxes', [$this, 'presscore_pages_with_basic_meta_boxes']);
        }

        function presscore_pages_with_basic_meta_boxes( $meta_boxes ){

            $meta_boxes = array_merge($meta_boxes, ['job_position']);

            return $meta_boxes;
        }

    }

    new reboot_the7_metabox_filters();

}

