<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('reboot_vc_shortcode')) {
    class reboot_vc_shortcode
    {
        public $settings;
        public $defaults;
        public $data;

        public $counter = 0;

        public static $scripts = [];

        function __construct($settings, $data = [])
        {
            // Settings
            $this->settings = $settings;
            $this->data = $data;

            // Defaults
            $this->defaults = array();
            foreach ($this->settings['params'] as $param) {
                $this->defaults[$param['param_name']] = isset($param['std'])
                    ? $param['std']
                    : (
                    isset($param['value']) && is_string($param['value'])
                        ? $param['value']
                        : ''
                    );
            }
        }

        function getSettings()
        {
            return $this->settings;
        }

        function handler($atts, $content = null, $tag = null)
        {
            $atts = shortcode_atts(
                $this->defaults,
                $atts,
                $this->settings['base']
            );

            $atts['counter'] = ++$this->counter;

            return $this->view($this->settings['base'], $atts, true, $this->defaults, $content, $tag);
        }

        public function view($view, $data = null, $return = null, $defaults = null, $_content = null, $_tag = null)
        {
            ob_start();

            if (!empty($data) && is_array($data)) {
                extract($data);
            }

            $file = $this->data['base_path'] . 'view.php';
            if (file_exists($file)) {
                include $file;
                $this->print_scripts();
            } else {
                include REBOOT_CORE_PATH . 'shortcodes/_shared/file-not-exists.php';
            }

            $output = ob_get_clean();

            if (!$return) {
                echo $output;
                return null;
            }

            return $output;
        }

        public function print_scripts()
        {
            if(isset($this->data['base_path']) && !empty($this->data['base_path'])) {

                if(file_exists($this->data['base_path'] . 'style.css')) {
                    $url = $this->data['base_url'] . 'style.css';
                    if(!in_array($url, self::$scripts)) {
                        self::$scripts[] = $url;
                        printf('<link href="%s" rel="stylesheet">', $url);
                    }
                }

                if(file_exists($this->data['base_path'] . 'script.js')) {
                    $url = $this->data['base_url'] . 'script.js';
                    if(!in_array($url, self::$scripts)) {
                        self::$scripts[] = $url;
                        printf('<script src="%s"></script>', $url);
                    }
                }

            }
        }

    }
}