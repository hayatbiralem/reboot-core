<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_tinymce_improvements')) {

    class reboot_tinymce_improvements
    {
        static $collections = [];

        function __construct()
        {
            // External plugins
            add_filter( 'mce_external_plugins', [$this, 'add_plugins'], 999 );

            // Register our callback to the appropriate filter
            add_filter( 'mce_buttons_2', [$this, 'mce_buttons_2'], 999 );

            // Attach callback to 'tiny_mce_before_init'
            add_filter( 'tiny_mce_before_init', [$this, 'tiny_mce_before_init'] );

            // Add editor style
            add_filter( 'mce_css', [$this, 'mce_css'], 10);

            // Add editor styles for Visual Composer's backend view
            add_action( 'wp_enqueue_scripts', [$this, 'bothend_enqueue_scripts'], 999 );
            add_action( 'admin_enqueue_scripts', [$this, 'bothend_enqueue_scripts'], 999 );
        }

        function get_mce_plugins() {
            if(isset(self::$collections['mce_plugins'])) {
                return self::$collections['mce_plugins'];
            }

            $mce_plugins = reboot_get_file_paths_by_folder(REBOOT_ASSETS_PATH, REBOOT_ASSETS_URL, 'backend/mce', 'plugin.js');
            $child_mce_plugins = reboot_get_file_paths_by_folder(REBOOT_CHILD_PATH, REBOOT_CHILD_URL, REBOOT_DIRECTORY_NAME . '/assets/backend/mce', 'plugin.js');

            self::$collections['mce_plugins'] =  array_merge($mce_plugins, $child_mce_plugins);

            return self::$collections['mce_plugins'];
        }

        function get_mce_buttons() {
            $buttons = [];

            $mce_plugins = $this->get_mce_plugins();

            if (!empty($mce_plugins)) {
                foreach ($mce_plugins as $file) {
                    $plugins = reboot_read_config($file['base_path'] . 'config.json', 'plugins', []);
                    if(!empty($plugins)) {
                        foreach ($plugins as $plugin) {
                            $buttons = array_merge($buttons, $plugin['buttons']);
                        }
                    }
                }
            }

            return $buttons;
        }

        function add_plugins($plugins_array) {
            $mce_plugins = $this->get_mce_plugins();

            if (!empty($mce_plugins)) {
                foreach ($mce_plugins as $file) {
                    $plugins = reboot_read_config($file['base_path'] . 'config.json', 'plugins', []);
                    if(!empty($plugins)) {
                        foreach ($plugins as $plugin) {
                            $plugins_array[ $plugin['id'] ] = $file['file_url'];
                        }
                    }
                }
            }

            return $plugins_array;
        }

        // Callback function to insert 'styleselect' into the $buttons array
        function mce_buttons_2( $buttons ) {
            array_unshift( $buttons, 'styleselect' );

            // $buttons = array_merge($buttons, $this->get_mce_buttons());
            $mce_buttons = $this->get_mce_buttons();

            if(!empty($mce_buttons)) {
                foreach ($mce_buttons as $mce_button) {
                    $buttons[] = $mce_button;
                }
            }

            return $buttons;
        }

        // Callback function to filter the MCE settings
        function tiny_mce_before_init( $init_array ) {
            // Define the style_formats array
            $style_formats = array(
                // Each array child is a format with it's own settings
                array(
                    'title' => 'Lead text!',
                    'block' => 'p',
                    'classes' => 'r-es-lead',
                    'wrapper' => false,
                ),

                array(
                    'title' => '> Centered Block <',
                    'block' => 'p',
                    'classes' => 'r-es-centered',
                    'wrapper' => false,
                ),
            );

            // Register a filter
            $style_formats = apply_filters('reboot_editor_style_formats', $style_formats);

            // Insert the array, JSON ENCODED, into 'style_formats'
            $init_array['style_formats'] = wp_json_encode( $style_formats );

            return $init_array;

        }

        /**
         * Add editor style
         */
        function mce_css( $mce_css ){
            $css_files = self::get_editor_styles();
            if(!empty($css_files)) {
                $mce_css .= ', ' . implode(', ', $css_files);
            }
            return $mce_css;
        }

        /**
         * Add admin styles
         */
        function bothend_enqueue_scripts( $mce_css ){
            $css_files = self::get_editor_styles(false);
            if(!empty($css_files)) {
                foreach ($css_files as $index => $css_file) {
                    wp_enqueue_style(REBOOT_AGENCY_SLUG . '-editor-style-' . $index, $css_file, false, REBOOT_ASSETS_VERSION);
                }
            }
            return $mce_css;
        }

        /**
         * Get editor styles
         */
        static function get_editor_styles($include_defaults = true){
            $css_files = [];

            if($include_defaults) {
                $css_files[] = REBOOT_CORE_URL . 'assets/bothend/css/editor-styles/style.css';
            }

            $additional_editor_css_files = apply_filters('reboot_editor_css_files', []);
            if(!empty($additional_editor_css_files)) {
                $css_files = array_merge($css_files, $additional_editor_css_files);
            }
            return $css_files;
        }

    }

    new reboot_tinymce_improvements();

}
