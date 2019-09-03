<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_common_param_extra_el_classes')) {

    class reboot_vc_common_param_extra_el_classes
    {

        public static $tags = [];

        /**
         * Constructor
         */
        public function __construct()
        {
            self::$tags = [
                'vc_section' => [
                    __('Has shadow') => 'u-shadow',
                    __('White text color') => 'u-text-white',
                    __('Has grayscale image hover') => 'has-grayscale-image-hover',
                    __('Has zigzag rows') => 'has-zigzag-rows',
                    __('Reset top padding of columns') => 'reset-top-padding-of-columns',
                ],
                'vc_row' => [
                    __('Has shadow') => 'u-shadow',
                    __('White text color') => 'u-text-white',
                    __('Has grayscale image hover') => 'has-grayscale-image-hover',
                    __('Has two columns at mobile') => 'has-two-columns-at-mobile',
                    __('Has one column under desktop') => 'has-one-column-under-desktop',
                    __('Has white bg overlay under desktop') => 'has-white-bg-overlay-under-desktop',
                    __('Increase font sizes base (makes all child font sizes equal, probably 16px)') => 'increase-font-sizes',
                    __('Increase font sizes 1.25x') => 'increase-font-sizes-1dot25x',
                    __('Increase font sizes 1.5x') => 'increase-font-sizes-1dot5x',
                    __('Increase font sizes 2x') => 'increase-font-sizes-2x',
                    __('Increase font sizes 2.5x') => 'increase-font-sizes-2dot5x',
                    __('Increase font sizes 3x') => 'increase-font-sizes-3x',
                    __('Reset top padding of columns') => 'reset-top-padding-of-columns',
                ],
                'vc_row_inner' => [
                    __('Has shadow') => 'u-shadow',
                    __('White text color') => 'u-text-white',
                    __('Has grayscale image hover') => 'has-grayscale-image-hover',
                    __('Has one column under desktop') => 'has-one-column-under-desktop',
                    __('Has white bg overlay under desktop') => 'has-white-bg-overlay-under-desktop',
                    __('Reset top padding of columns') => 'reset-top-padding-of-columns',
                ],
                'vc_column' => [
                    __('Has shadow') => 'u-shadow',
                    __('White text color') => 'u-text-white',
                ],
                'vc_column_inner' => [
                    __('Has shadow') => 'u-shadow',
                    __('White text color') => 'u-text-white',
                ],
                'vc_single_image' => [
                    __('Force full width single image') => 'force-full-width-single-image',
                ],
            ];

            add_action('vc_after_init', array($this, 'add_params'), 10, 0);
            add_action('vc_after_init', array($this, 'shortcode_atts_hooks'), 20, 0);
        }

        public function shortcode_atts_hooks()
        {
            foreach (self::$tags as $tag => $value) {
                add_filter("shortcode_atts_{$tag}", array($this, 'filter'), 999, 4);
            }
        }

        public function add_params()
        {
            self::$tags = apply_filters('reboot_vc_common_param_extra_el_classes', self::$tags);

            // add
            foreach (self::$tags as $tag => $value) {

                if(empty($value)) {
                    continue;
                }

                // params
                $params = array(

                    array(
                        "type" => "checkbox",
                        "heading" => __("Classes", REBOOT_CORE_TEXT_DOMAIN),
                        "param_name" => "extra_el_classes",
                        "value" => $value,
                        'group' => sprintf(__('%s Classes', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                    ),

                );

                vc_add_params($tag, $params);
            }

        }

        public function filter($out, $pairs, $atts, $shortcode)
        {
            self::$tags = apply_filters('reboot_vc_common_param_extra_el_classes', self::$tags);

            if (!array_key_exists($shortcode, self::$tags)) {
                return $out;
            }

            if (isset($atts['extra_el_classes']) && !empty($atts['extra_el_classes'])) {
                if(!isset($out['el_class'])) {
                    $out['el_class'] = '';
                }

                $out['el_class'] .= ' ' . str_replace(',', ' ', $atts['extra_el_classes']);
                $out['el_class'] = trim($out['el_class']);
            }

            return $out;
        }

    }

    new reboot_vc_common_param_extra_el_classes();

}