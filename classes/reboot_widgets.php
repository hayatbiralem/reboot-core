<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('reboot_widgets')) {

    class reboot_widgets
    {

        public $widgets = [];
        public $paths = [];

        /**
         * Constructor
         */
        public function __construct()
        {
            $paths = $this->get_paths();

            if(!empty($paths)) {
                $this->paths = [];
                foreach ($paths as $path => $url) {
                    $folder_paths = reboot_get_file_paths_by_folder($path, $url, 'widgets', 'widget.php');
                    if(!empty($folder_paths)) {
                        $this->paths = array_merge($this->paths, $folder_paths);
                    }
                }
            }

            // reboot_dd($this->paths);

            if(!empty($this->paths)) {

                foreach ($this->paths as $file_path) {
                    require_once $file_path['file_path'];
                    $hooks_file_path = $file_path['base_path'] . 'hooks.php';
                    if(file_exists($hooks_file_path)) {
                        require_once $hooks_file_path;
                    }
                }

            }

            $this->widgets = array_column($this->paths, 'sub_dir_name');
            add_action('widgets_init', [$this, 'register']);
        }

        /**
         * Collect available widget classes
         *
         * @param array $args
         */
        public function collect($args)
        {
            $this->widgets[] = $args['name'];
        }

        public function register()
        {
            if(!empty($this->widgets) && is_array($this->widgets)) {
                foreach ($this->widgets as $widget) {
                    register_widget($widget);
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
    }

    new reboot_widgets();

}
