<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_admin_bar_menu')) {

    class reboot_admin_bar_menu
    {

        function __construct()
        {
            // Item Definition
            $replace = [
                11 => [
                    'wp-logo' => [
                        'title' => sprintf('<span class="%s"></span><span class="screen-reader-text">%s</span>', REBOOT_AGENCY_MENU_ICON, REBOOT_AGENCY),
                        'href' => REBOOT_AGENCY_URL,
                        'meta' => [
                            'target' => '_blank'
                        ]
                    ],

                    'about' => [
                        'title' => sprintf(__('About %s', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                        'href' => REBOOT_AGENCY_URL,
                        'meta' => [
                            'target' => '_blank'
                        ]
                    ],
                ],
            ];

            $add = [
                [
                    'id' => sprintf('%s-send-mail', REBOOT_AGENCY_SLUG),
                    'title' => REBOOT_AGENCY_EMAIL,
                    'href' => sprintf('mailto:%s', REBOOT_AGENCY_EMAIL),
                    'parent' => 'wp-logo-external',
                    'group' => false,
                    'meta' => [],
                ]
            ];

            $remove = [
                'wporg',
                'documentation',
                'feedback',
                'support-forums',
            ];

            $instance = $this;

            foreach ($replace as $priority => $nodes) {
                add_action('admin_bar_menu', function ($wp_admin_bar) use ($instance, $nodes) {
                    $instance->replace($wp_admin_bar, $nodes);
                }, $priority);
            }

            add_action('wp_before_admin_bar_render', function() use ($instance, $add, $remove){
                $instance->add($add);
                $instance->remove($remove);
            }, 9999);
        }

        /**
         * @param WP_Admin_Bar $wp_admin_bar
         * @param array $nodes
         */
        public function replace($wp_admin_bar, $nodes)
        {
            foreach ($nodes as $key => $node) {
                $default_node = (array)$wp_admin_bar->get_node($key);
                $wp_admin_bar->remove_node($key);
                $node = array_merge($default_node, $node);
                $wp_admin_bar->add_node($node);
            }
        }

        /**
         * @param array $nodes
         */
        public function add($nodes)
        {
            /** @var WP_Admin_Bar $wp_admin_bar */
            global $wp_admin_bar;

            foreach ($nodes as $node) {
                $wp_admin_bar->add_node($node);
            }
        }

        /**
         * @param WP_Admin_Bar $wp_admin_bar
         * @param array $ids
         */
        public function remove($ids)
        {
            /** @var WP_Admin_Bar $wp_admin_bar */
            global $wp_admin_bar;

            foreach ($ids as $id) {
                $wp_admin_bar->remove_node($id);
            }
        }

    }

    new reboot_admin_bar_menu();

}
