<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_common_param_condition')) {

    class reboot_vc_common_param_condition
    {

        public static $tags = [
            'vc_section',
            'vc_row',
            'vc_row_inner',
        ];

        /**
         * Constructor
         */
        public function __construct()
        {
            add_action( 'vc_after_init', array($this, 'add_params'), 10, 0 );

            foreach (self::$tags as $tag) {
                add_filter( "shortcode_atts_{$tag}", array($this, 'filter'), 999, 4 );
            }
        }

        public function add_params(){

            // params
            $params = array(

                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Condition", REBOOT_CORE_TEXT_DOMAIN),
                    "param_name" => "condition",
                    "value" => "",
                    "description" => __("You can set some condition here like <code>{call:function_name}</code> or <code>{call:class_name->method_name}</code>. <br>You can send params like <code>{call:function_name(Param 1, Param 2)}</code>", REBOOT_CORE_TEXT_DOMAIN),
                    'group' => sprintf(__('%s Condition', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                ),

            );

            // add
            foreach (self::$tags as $tag) {
                vc_add_params( $tag, $params );
            }

        }

        public function filter($out, $pairs, $atts, $shortcode){

            if(!in_array($shortcode, self::$tags)) {
                return $out;
            }

            if (isset($out['condition']) && !empty($out['condition'])) {
                $out['condition'] = reboot_replace_special_vars( $out['condition'] );

                if(!filter_var($out['condition'], FILTER_VALIDATE_BOOLEAN)) {
                    $out['disable_element'] = 'yes';
                    // $out['el_class'] .= ' vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
                }
            }

            return $out;
        }

    }

    new reboot_vc_common_param_condition();

}