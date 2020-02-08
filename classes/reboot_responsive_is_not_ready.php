<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_responsive_is_not_ready')) {

    class reboot_responsive_is_not_ready
    {

        public static $enabled = false;

        function __construct()
        {
            add_action('wp_head', [$this, 'wp_head']);
        }

        public function wp_head()
        {
            self::output();
        }

        public static function output($args = []){
            $defaults = array (
                'enabled' => false,
                'min_width' => null,
                'max_width' => 1199,
                'content' => "Responsive is not ready yet.",
            );

            foreach ($defaults as $key => &$arg) {
                $arg = apply_filters('reboot_responsive_is_not_ready_' . $key, $arg);
            }
            unset($arg);

            $args = wp_parse_args($args, $defaults);

            if(!$args['enabled']) {
                return;
            }

            ?>
            <style>
                @media (max-width: 1199px) {
                    html,
                    html body {
                        height: calc(100vh - 32px) !important;
                        margin: 0 !important;
                        padding: 0 !important;
                    }

                    html body * {
                        display: none !important;
                    }

                    html body:before {
                        position: absolute;
                        top: 50%;

                        content: "Responsive is not ready yet.";
                        display: block;
                        width: 100%;
                        padding: 50px;
                        margin-top: -75px;

                        text-align: center;

                        box-sizing: border-box;
                    }
                }
            </style>
            <?php
        }

        public static function enable(){
            if(!self::$enabled) {
                self::$enabled = true;
                add_filter('reboot_responsive_is_not_ready_enabled', '__return_true', 10, 1);
            }
        }

    }

    new reboot_responsive_is_not_ready();

}
