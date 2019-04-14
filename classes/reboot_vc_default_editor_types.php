<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('reboot_vc_default_editor_types')) {

    class reboot_vc_default_editor_types
    {
        var $shortcodes;
        var $categories;
        var $paths;

        /**
         * Constructor
         */
        public function __construct()
        {
            add_action('init', [$this, 'set_types']);
        }

        function set_types() {
            if(function_exists('vc_set_default_editor_post_types')) {
                vc_set_default_editor_post_types( apply_filters( 'reboot_vc_default_editor_types', array( 'page', 'post', 'block' ) ) );
            }
        }
    }

    new reboot_vc_default_editor_types();
}
