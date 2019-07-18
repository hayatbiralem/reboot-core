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

//                array(
//                    "type" => "textfield",
//                    "class" => "",
//                    "heading" => __("Condition", REBOOT_CORE_TEXT_DOMAIN),
//                    "param_name" => "condition",
//                    "value" => "",
//                    "description" => __("You can set some condition here like <code>{call:function_name}</code> or <code>{call:class_name->method_name}</code>. <br>You can send params like <code>{call:function_name(Param 1, Param 2)}</code>", REBOOT_CORE_TEXT_DOMAIN) . ' ' .
//                        __("You can also use some modifier here like <code>{call:function_name}::is::some_modifier</code>", REBOOT_CORE_TEXT_DOMAIN) . ' ' .
//                        __("Available modifiers are <code>true</code>, <code>false</code>, <code>empty</code>, <code>not-empty</code>, <code>equal:some_value</code>, <code>not-equal:some_value</code>", REBOOT_CORE_TEXT_DOMAIN) . ' ' .
//                        __("If you don't specify any modifier then <code>true</code> used by default.", REBOOT_CORE_TEXT_DOMAIN),
//                    'group' => sprintf(__('%s Condition', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
//                ),

                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Expression", REBOOT_CORE_TEXT_DOMAIN),
                    "param_name" => "condition_expression",
                    "value" => "",
                    'admin_label' => true,
                    "description" => __("You can set some condition here like <code>{call:function_name}</code> or <code>{call:class_name->method_name}</code>. <br>You can send params like <code>{call:function_name(Param 1, Param 2)}</code>", REBOOT_CORE_TEXT_DOMAIN),
                    'group' => sprintf(__('%s Condition', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                ),

                array(
                    'type' => 'dropdown',
                    'heading' => __('Compare', REBOOT_CORE_TEXT_DOMAIN),
                    'param_name' => 'condition_compare',
                    'value' => [
                        __('True', REBOOT_CORE_TEXT_DOMAIN) => '',
                        __('False', REBOOT_CORE_TEXT_DOMAIN) => 'false',
                        __('Empty', REBOOT_CORE_TEXT_DOMAIN) => 'empty',
                        __('Not Empty', REBOOT_CORE_TEXT_DOMAIN) => 'not-empty',
                        __('Equal', REBOOT_CORE_TEXT_DOMAIN) => 'equal',
                        __('Not Equal', REBOOT_CORE_TEXT_DOMAIN) => 'not-equal',
                    ],
                    'std' => '',
                    'admin_label' => true,
                    'description' => __('Select a comparison type.', REBOOT_CORE_TEXT_DOMAIN),
                    'dependency' => array(
                        'element' => 'condition_expression',
                        'not_empty' => true,
                    ),
                    'group' => sprintf(__('%s Condition', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                ),

                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Value", REBOOT_CORE_TEXT_DOMAIN),
                    "param_name" => "condition_value",
                    "value" => "",
                    'admin_label' => true,
                    "description" => __("You can set some condition here like <code>{call:function_name}</code> or <code>{call:class_name->method_name}</code>. <br>You can send params like <code>{call:function_name(Param 1, Param 2)}</code>", REBOOT_CORE_TEXT_DOMAIN),
                    'dependency' => array(
                        'element' => 'condition_compare',
                        'value' => array( 'equal', 'not-equal' ),
                    ),
                    'group' => sprintf(__('%s Condition', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                ),

            );

            // add
            foreach (self::$tags as $tag) {
                vc_add_params( $tag, $params );
            }

        }

        public function filter($out, $pairs, $atts, $shortcode){

//            if($out['el_id'] == 'asdasdasd') {
//                reboot_dd([
//                    '$out' => $out,
//                    '$atts' => $atts,
//                ]);
//            }

            if(!in_array($shortcode, self::$tags)) {
                return $out;
            }

            if (isset($out['condition_expression']) && !empty($out['condition_expression'])) {
                $expression = $out['condition_expression'];
                $compare = isset($out['condition_compare']) && !empty($out['condition_compare']) ? $out['condition_compare'] : 'true';
                $value = isset($out['condition_value']) ? $out['condition_value'] : '';

                $expression = reboot_replace_special_vars( $expression );

                if(!empty($value)) {
                    $value = reboot_replace_special_vars( $value );
                }

                $is_valid = true;

                switch($compare) {

                    case 'true':
                        if(!filter_var($expression, FILTER_VALIDATE_BOOLEAN)) {
                            $is_valid = false;
                        }
                        break;

                    case 'false':
                        if(filter_var($expression, FILTER_VALIDATE_BOOLEAN)) {
                            $is_valid = false;
                        }
                        break;

                    case 'empty':
                        if(!empty($expression)) {
                            $is_valid = false;
                        }
                        break;

                    case 'not-empty':
                        if(empty($expression)) {
                            $is_valid = false;
                        }
                        break;

                    case 'equal':
                        if($expression !== $value) {
                            $is_valid = false;
                        }
                        break;

                    case 'not-equal':
                        if($expression === $value) {
                            $is_valid = false;
                        }
                        break;

                }

                if(!$is_valid) {
                    $out['disable_element'] = 'yes';
                    // $out['el_class'] .= ' vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
                }
            }

            return $out;
        }

    }

    new reboot_vc_common_param_condition();

}