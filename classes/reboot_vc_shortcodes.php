<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('reboot_vc_shortcodes')) {

    class reboot_vc_shortcodes
    {
        var $shortcodes;
        var $categories;
        var $paths;

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->shortcodes = array();
            $this->categories = array();

            $this->include_shortcodes();
            $this->add_shortcodes();
            $this->hook_settings();
        }

        /**
         * include_shortcodes
         *
         * @return void
         */
        function include_shortcodes()
        {
            if(!class_exists('reboot_vc_shortcode')) {
                require_once REBOOT_CORE_PATH . 'classes/reboot_vc_shortcode.php';
            }

            $paths = $this->get_paths();

            if(!empty($paths)) {
                $this->paths = [];
                foreach ($paths as $path => $url) {
                    $folder_paths = reboot_get_file_paths_by_folder($path, $url, 'shortcodes', 'params.php');
                    if(!empty($folder_paths)) {
                        $this->paths = array_merge($this->paths, $folder_paths);
                    }
                }
            }

            // reboot_dd($this->paths);

            if(!empty($this->paths)) {

                foreach ($this->paths as $shortcode_path) {
                    $settings = include $shortcode_path['file_path'];
                    if (!isset($this->shortcodes[$settings['base']])) {
                        $this->shortcodes[$settings['base']] = new reboot_vc_shortcode($settings, $shortcode_path);
                    }
                }

            }
        }

        function get_paths()
        {
            $paths = [];
            $paths[REBOOT_CORE_PATH] = REBOOT_CORE_URL;
            $paths[REBOOT_CHILD_PATH . REBOOT_DIRECTORY_NAME . '/'] = REBOOT_CHILD_URL . REBOOT_DIRECTORY_NAME . '/';
            $paths = apply_filters('reboot_vc_shortcode_paths', $paths);
            return $paths;
        }

        /**
         * init_shortcodes
         *
         * @return void
         */
        function add_shortcodes()
        {
            foreach ($this->shortcodes as $base => $shortcode) {
                add_shortcode($base, array($shortcode, 'handler'));
            }
        }

        /**
         * hook_settings
         *
         * @return void
         */
        function hook_settings()
        {
            add_action('vc_before_init', array($this, 'add_settings'));
            add_action('admin_print_styles', array($this, 'admin_print_styles'));

            foreach ($this->shortcodes as $base => $shortcode) {
                if(file_exists($shortcode->data['base_path'] . '/hooks.php')) {
                    require_once $shortcode->data['base_path'] . '/hooks.php';
                }
            }
        }

        function admin_print_styles()
        {
            $rules = ['[data-element_type*="reboot_"] .wpb_vc_param_value.textarea_raw_html { display: none !important; }'];
            $shared_icon_rule = [];
            $available_file_types = ['svg', 'png'];
            foreach ($this->shortcodes as $base => $shortcode) {
                /** @var reboot_vc_shortcode $shortcode */
                $icon = $shortcode->settings['icon'];
                if(!isset($rules[$icon])) {
                    foreach ($available_file_types as $available_file_type) {
                        if( file_exists( $shortcode->data['base_path'] . '/icon.' . $available_file_type ) ) {
                            $rules[$icon] = sprintf(
                                '.vc_element-icon.%s { background-image: url(%s); }',
                                $icon,
                                $shortcode->data['base_url'] . '/icon.' . $available_file_type
                            );
                        } else if( file_exists( REBOOT_CORE_PATH . 'shortcodes/_shared/' . $icon . '.' . $available_file_type ) ) {
                            $rules[$icon] = sprintf(
                                '.vc_element-icon.%s { background-image: url(%s); }',
                                $icon,
                                REBOOT_CORE_URL . 'shortcodes/_shared/' . $icon . '.' . $available_file_type
                            );
                        }
                    }
                }
            }

            foreach ($this->shortcodes as $base => $shortcode) {
                $icon = $shortcode->settings['icon'];
                if(!isset($rules[$icon]) && !isset($shared_icons_rule[$icon])) {
                    $shared_icon_rule[$icon] = sprintf('.vc_element-icon.%s', $icon);
                }
            }

            // agency
            if(!empty($shared_icon_rule)) {
                $shared_icons_rule = implode(', ', $shared_icon_rule);
                $rules = array_merge(
                    [
                        'shared-icons' => sprintf(
                            '%s { background-image: url(%s); }',
                            $shared_icons_rule,
                            (file_exists( REBOOT_CORE_PATH . 'shortcodes/_shared/icon-' . REBOOT_AGENCY_SLUG . '.svg') ? REBOOT_CORE_URL . 'shortcodes/_shared/icon-' . REBOOT_AGENCY_SLUG . '.svg' : REBOOT_CORE_URL . 'shortcodes/_shared/icon.svg')
                        )
                    ],
                    $rules
                );
            }

            $rules = implode("\n", $rules);
            printf('<style>%s</style>', $rules);
        }

        /**
         * custom_vc_maps
         *
         * @return void
         */
        function add_settings()
        {
            foreach ($this->shortcodes as $base => $shortcode) {
                vc_lean_map($base, array($shortcode, 'getSettings'));
            }
        }
    }

    new reboot_vc_shortcodes();
}
