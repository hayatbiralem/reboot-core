<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_common_param_shape_backgrounds')) {

    class reboot_vc_common_param_shape_backgrounds
    {
        public static $shapes = [
            "1" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2569.8 714"><path d="M2569.8 714H310c1.5-80-18.9-153.8-60.5-219.1-8.9-14-18.6-27.5-29.1-40.5-9.3-11.5-19.2-22.5-29.6-33-19.8-20-39.4-36.3-58.3-52-19.9-16.5-38.6-32.1-55.5-50.2-8.7-9.2-16.6-19.1-23.8-29.5-3.8-5.5-7.3-11.2-10.6-16.9-3.4-6-6.7-12.3-9.7-18.8-13-28.1-21.8-60.7-27.1-99.8a522.2 522.2 0 01-3.4-32.7C1.4 110 .8 97.7.4 85.1-.4 59.3 0 30.6 1.4 0h2568.4v714z"/></svg>'
        ];

        /**
         * Constructor
         */
        public function __construct()
        {
            add_action( 'vc_after_init', array($this, 'add_params'), 11, 0 );

            add_filter( "shortcode_atts_vc_row", array($this, 'atts_filter_vc_row'), 999, 4 );
            add_filter( "do_shortcode_tag", array($this, 'output_filter_vc_row'), 999, 4 );
        }

        public static function getParamsToAdd()
        {
            // $group_name = 'Background';
            $group_effects = 'Effect';
            return array(
                'vc_row' => array(
                    array(
                        'type' => 'ult_switch',
                        'heading' => __('BrainWork :: Shape Mask',REBOOT_CORE_TEXT_DOMAIN),
                        'param_name' => 'brainwork_shape_mask',
                        'value' => '',
                        'options' => array(
                            'on' => array(
                                'on' => __('Yes',REBOOT_CORE_TEXT_DOMAIN),
                                'off' => __('No',REBOOT_CORE_TEXT_DOMAIN)
                            )
                        ),
                        'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
                        'group' => $group_effects,
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Shape", REBOOT_CORE_TEXT_DOMAIN),
                        "param_name" => "brainwork_shape_mask_shape",
                        "value" => array(
                            __("Shape #1", REBOOT_CORE_TEXT_DOMAIN) => "",
                        ),
                        "description" => __("You can select from the predefined shapes to mask the background.", REBOOT_CORE_TEXT_DOMAIN),
                        "group" => $group_effects,
                        'dependency' => [
                            'element' => 'brainwork_shape_mask',
                            'value' => ['on']
                        ]
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => __("Fill Color", REBOOT_CORE_TEXT_DOMAIN),
                        "param_name" => "brainwork_shape_mask_color",
                        "value" => "#FFF8EB",
                        "description" => __("Give it a nice paint!", REBOOT_CORE_TEXT_DOMAIN),
                        'dependency' => [
                            'element' => 'brainwork_shape_mask',
                            'value' => ['on']
                        ],
                        "group" => $group_effects,
                    ),
                )
            );
        }

        public function add_params()
        {
            if(!function_exists('vc_add_params')) {
                return;
            }

            // params
            $paramsToAdd = $this->getParamsToAdd();

            // add
            if (!empty($paramsToAdd)) {
                foreach ($paramsToAdd as $tag => $params) {
                    vc_add_params($tag, $params);
                }
            }

        }

        public function atts_filter_vc_row($out, $pairs, $atts, $shortcode){

            // reboot_d($out, null, null, null);

            if(!isset($out['brainwork_shape_mask']) || $out['brainwork_shape_mask'] != 'on') {
                return $out;
            }


            // $shape = $out['brainwork_shape_mask_shape'] ?: '1';

            if(!isset($out['el_class'])) {
                $out['el_class'] = '';
            }

            $out['el_class'] .= ' has-brainwork_shape_mask';
            $out['el_class'] = trim($out['el_class']);

            return $out;
        }

        public function output_filter_vc_row($output, $tag, $attr, $m)
        {
            if($tag != 'vc_row') {
                return $output;
            }

            // return reboot_d($attr, null, true, null) . $output;

            if(!isset($attr['brainwork_shape_mask']) || $attr['brainwork_shape_mask'] != 'on') {
                return $output;
            }

            $shape = $attr['brainwork_shape_mask_shape'] ?: '1';
            $attr_additions = ' data-brainwork-shape-mask="'.$shape.'"';

            if(!isset(self::$shapes[$shape])) {
                return $output;
            }

            $css = [];

            $color = $attr['brainwork_shape_mask_color'] ?: '#FFF8EB';
            $css[] = sprintf('color: %s;', $color);

            if(!empty($css)) {
                $css = sprintf(' style="%s"', implode(' ', $css));
            } else {
                $css = '';
            }

            $svg = self::$shapes[$shape];
            $svg = str_replace('<svg ', '<svg class="c-brainwork-shape__svg" ', $svg);
            $html_additions = '<div class="c-brainwork-shape c-brainwork-shape--'.$shape.'" '.$css.'>'.$svg.'</div>';

            $re = '/(has-brainwork_shape_mask[^>]*)>/m';
            preg_match_all($re, $output, $matches, PREG_SET_ORDER, 0);

            if(isset($matches[0][1]) && !empty($matches[0][1])) {
                return str_replace(
                    $matches[0][0],
                    $matches[0][1] . $attr_additions . '>' . $html_additions,
                    $output
                );
            }

            return $output;
        }

    }


    new reboot_vc_common_param_shape_backgrounds();

}