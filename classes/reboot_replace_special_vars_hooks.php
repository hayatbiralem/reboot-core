<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!is_admin()) {

    if (!class_exists('reboot_replace_special_vars_hooks')) {

        class reboot_replace_special_vars_hooks
        {

            static $attributes = [
                'reboot_template' => ['condition'],
//                'vc_section' => ['condition'],
//                'vc_row' => ['condition'],
                'vc_basic_grid' => ['custom_query'],
                'vc_custom_heading' => ['text'],
            ];

            static $contents = [
                'dt_default_button',
            ];

            public function __construct()
            {
                foreach (self::$attributes as $shortcode => $atts) {
                    add_filter( "shortcode_atts_{$shortcode}", array($this, 'filter_atts'), 20, 4 );
                }

                add_filter( "do_shortcode_tag", array($this, 'filter_output'), 20, 4 );
            }

            public function filter_atts($out, $pairs, $atts, $shortcode){
                foreach (self::$attributes[$shortcode] as $att) {
                    $out[$att] = reboot_replace_special_vars( $out[$att] );
                }
                return $out;
            }

            public function filter_output($output, $tag, $attr, $m){
                if(!in_array($tag, self::$contents)) {
                    return $output;
                }
                return reboot_replace_special_vars($output);
            }

        }

        new reboot_replace_special_vars_hooks();

    }

}

