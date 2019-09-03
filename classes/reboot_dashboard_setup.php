<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('reboot_dashboard_setup')) {

    class reboot_dashboard_setup
    {

        function __construct()
        {
            add_action('wp_dashboard_setup', array($this, 'remove_unnecessary_dashboard_widgets'), 99);
        }

        /**
         * @return void
         */
        function remove_unnecessary_dashboard_widgets()
        {
            global $wp_meta_boxes;

            // wp..
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
            // bbpress
            unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);
            // yoast seo
            unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
            // unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
            // gravity forms
            unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
            // YIHT
            unset($wp_meta_boxes['dashboard']['normal']['core']['yith_dashboard_products_news']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['yith_dashboard_blog_news']);
        }

    }

    new reboot_dashboard_setup();

}
