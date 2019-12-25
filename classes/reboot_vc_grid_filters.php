<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_grid_filters')) {

    class reboot_vc_grid_filters
    {

        function __construct()
        {
            add_filter('shortcode_atts');
        }



    }

    new reboot_vc_grid_filters();

}
