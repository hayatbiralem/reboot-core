<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!is_admin()) {

    if (!class_exists('reboot_replace_special_vars_hooks')) {

        class reboot_replace_special_vars_hooks
        {

            static $attributes = [
                'vc_basic_grid' => ['custom_query'],
                'vc_custom_heading' => ['text'],
                'dt_fancy_image' => ['image'],
            ];

            static $contents = [
                'vc_column_text',
                'reboot_shortcode',
                'dt_default_button',
                'ultimate_heading',
                'ultimate_icon_list_item',
            ];

            public function __construct()
            {
                foreach (self::$attributes as $shortcode => $atts) {
                    add_filter( "shortcode_atts_{$shortcode}", array($this, 'filter_atts'), 20, 5 );
                }

                add_filter( "do_shortcode_tag", array($this, 'filter_output'), 20, 4 );

                add_filter('the_content', [$this, 'filter_the_content'], 999, 1);
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

            public function filter_the_content($content){
                return reboot_replace_special_vars($content);
            }

        }

        new reboot_replace_special_vars_hooks();

    }

}

