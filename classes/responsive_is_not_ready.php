<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('responsive_is_not_ready')) {

    class responsive_is_not_ready
    {

        function __construct()
        {
            add_action('wp_head', [$this, 'styles'], 99);
        }

        function is_active()
        {
            return apply_filters('responsive_is_not_ready', defined('RESPONSIVE_IS_NOT_READY') ? RESPONSIVE_IS_NOT_READY : false);
        }

        function styles()
        {
            if (!$this->is_active()) {
                return;
            }

            ?>
            <style>
                /**
                 * Responsive is not ready!
                 */

                @media (max-width: 1199px) {
                    html[lang][class] body {
                        height: 100vh !important;
                        margin: 0 !important;
                        padding: 0 !important;
                    }

                    html[lang][class] body.admin-bar {
                        height: calc(100vh - 32px) !important;
                    }

                    html[lang][class] body * {
                        position: absolute !important;
                        display: none !important;
                        visibility: hidden !important;
                        opacity: 0 !important;
                        font-size: 0 !important;
                    }

                    html[lang][class] body:before {
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

    }

    new responsive_is_not_ready();

}

