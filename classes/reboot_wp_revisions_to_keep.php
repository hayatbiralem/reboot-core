<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_wp_revisions_to_keep')) {

    class reboot_wp_revisions_to_keep
    {

        function __construct()
        {
            add_filter('wp_revisions_to_keep', [$this, 'wp_revisions_to_keep'], 10, 2);
        }

        function wp_revisions_to_keep($num, $post)
        {
            $num = 0;
            return apply_filters('reboot_wp_revisions_to_keep', $num, $post);
        }

    }

    new reboot_wp_revisions_to_keep();

}

