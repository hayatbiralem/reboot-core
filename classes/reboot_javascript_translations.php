<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_javascript_translations')) {

    class reboot_javascript_translations
    {

        static $handle;
        static $translations = [];

        function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'wp_localize_script'), 9999995, 0);
        }

        static function load_translations($file, $handle)
        {
            if (file_exists($file)) {
                $translations = null;
                require_once $file;

                if(!empty($translations) && is_array($translations)) {
                    self::$translations = array_merge(self::$translations, $translations);

                    if(!isset(self::$handle)) {
                        self::$handle = $handle;
                    }
                }
            }
        }

        function wp_localize_script()
        {
            if(!empty(self::$translations)) {
                wp_localize_script( self::$handle, 'reboot_javascript_translations', self::$translations );
            }
        }

    }

    new reboot_javascript_translations();

}

