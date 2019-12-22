<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_revslider_svg_sets')) {

    class reboot_revslider_svg_sets
    {

        function __construct()
        {
            add_filter('revslider_get_svg_sets', [$this, 'revslider_get_svg_sets'], 10, 1);
        }

        public function revslider_get_svg_sets($svg_sets)
        {
            if(REBOOT_IS_CHILD) {
                $path	= REBOOT_CHILD_PATH . REBOOT_DIRECTORY_NAME . '/assets/svg/';
                if(file_exists($path)) {
                    $url	= REBOOT_CHILD_URL . REBOOT_DIRECTORY_NAME . '/assets/svg/';
                    $svg_sets[ REBOOT_AGENCY ]		= array('path' => $path, 'url' => $url);
                }
            }

            return $svg_sets;
        }

    }

    new reboot_revslider_svg_sets();

}
