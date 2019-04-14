<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('reboot_widgets')) {

    class reboot_widgets
    {

        public $widgets = [];

        /**
         * Constructor
         */
        public function __construct()
        {
            $file_paths = reboot_get_file_paths_by_folder( REBOOT_CORE_PATH, REBOOT_CORE_URL, 'widgets', 'widget.php' );
            foreach ($file_paths as $file_path) {
                require_once $file_path['file_path'];

                $hooks_file_path = $file_path['base_path'] . 'hooks.php';
                if(file_exists($hooks_file_path)) {
                    require_once $hooks_file_path;
                }
            }

            $this->widgets = array_column($file_paths, 'sub_dir_name');
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
    }

    new reboot_widgets();

}
