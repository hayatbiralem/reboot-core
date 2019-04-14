<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!class_exists('reboot_admin_menu_order')) {

    class reboot_admin_menu_order {

        function __construct()
        {
            add_filter('custom_menu_order', '__return_true');
            add_filter('menu_order', array($this, 'menu_order'));

            add_filter('wp_insert_post_data',array($this, 'wp_insert_post_data'),10,2);
        }

        function menu_order(){
            $menu_order = array(
                'index.php',
                'the7-dashboard',
                REBOOT_AGENCY_SLUG,
                'edit.php?post_type=block',
            );

            return apply_filters('reboot_admin_menu_order', $menu_order);
        }

        function wp_insert_post_data($data, $postarr) {
            if(post_type_supports($data['post_type'], 'page-attributes') && get_post_status($postarr['ID']) == 'draft') {
                global $wpdb;
                $data['menu_order'] = $wpdb->get_var("SELECT MAX(menu_order)+1 AS menu_order FROM {$wpdb->posts} WHERE post_type='{$data['post_type']}'");
            }

            return $data;
        }

    }

    new reboot_admin_menu_order();

}

