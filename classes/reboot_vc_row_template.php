<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_row_template')) {

    class reboot_vc_row_template
    {

        public static $tags = [];

        /**
         * Constructor
         */
        public function __construct()
        {
            self::$tags = [
                'vc_section',
                'vc_row',
                'vc_row_inner',
            ];

            add_action('vc_after_init', array($this, 'add_params'), 10, 0);
            // add_action('vc_after_init', array($this, 'shortcode_atts_hooks'), 20, 0);

            $this->add_do_shortcode_tag_hook();

            add_filter('reboot_template_formatters', [$this]);
        }

//        public function shortcode_atts_hooks()
//        {
//            foreach (self::$tags as $tag) {
//                add_filter("shortcode_atts_{$tag}", array($this, 'filter'), 999, 4);
//            }
//        }

        public function add_params()
        {
            self::$tags = apply_filters('reboot_vc_row_template', self::$tags);

            // add
            foreach (self::$tags as $tag) {

                // params
                $params = array(

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Block', REBOOT_CORE_TEXT_DOMAIN),
                        'value' => array_merge(
                            [ __('Select...', REBOOT_CORE_TEXT_DOMAIN) => '' ],
                            reboot_get_post_ids('block')
                        ),
                        'std' => '',
                        'admin_label' => true,
                        'param_name' => 'reboot_template',
                        'description' => __('Select block.', REBOOT_CORE_TEXT_DOMAIN),
                        'group' => sprintf(__('%s Template', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Formatter', REBOOT_CORE_TEXT_DOMAIN),
                        'value' => array_merge(
                            [ __('Select...', REBOOT_CORE_TEXT_DOMAIN) => '' ],
                            reboot_get_template_formatters()
                        ),
                        'std' => '',
                        'admin_label' => true,
                        'param_name' => 'reboot_template_formatter',
                        'description' => __('Select formatter.', REBOOT_CORE_TEXT_DOMAIN),
                        'group' => sprintf(__('%s Template', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                    ),

                );

                vc_add_params($tag, $params);
            }

        }

        public function filter($out, $pairs, $atts, $shortcode)
        {
            self::$tags = apply_filters('reboot_vc_row_template', self::$tags);

            if (!in_array($shortcode, self::$tags)) {
                return $out;
            }

            if (isset($atts['reboot_template']) && !empty($atts['reboot_template'])) {
                if(!isset($out['el_class'])) {
                    $out['el_class'] = '';
                }

                $out['el_class'] .= ' ' . str_replace(',', ' ', $atts['extra_el_classes']);
                $out['el_class'] = trim($out['el_class']);
            }

            return $out;
        }

        public function do_shortcode_tag($output, $tag, $attr, $m)
        {
            self::$tags = apply_filters('reboot_vc_row_template', self::$tags);

            if (!in_array($tag, self::$tags)) {
                return $output;
            }

            if (isset($attr['reboot_template']) && !empty($attr['reboot_template'])) {

                // $this->remove_do_shortcode_tag_hook();
                $replace = do_shortcode('[reboot_template id="'.$attr['reboot_template'].'" disable_wrapper="1"'.( $attr['reboot_template_formatter'] ? ' formatter="'.$attr['reboot_template_formatter'].'"' : '' ).']');
                // $this->add_do_shortcode_tag_hook();

                $replace = trim($replace);
                if(!empty($replace)) {
                    return $replace;
                }
            }

            return $output;
        }

        public function add_do_shortcode_tag_hook(){
            add_filter('do_shortcode_tag', array($this, 'do_shortcode_tag'), 99, 4);
        }

        public function remove_do_shortcode_tag_hook(){
            remove_filter('do_shortcode_tag', array($this, 'do_shortcode_tag'), 99);
        }

    }

    new reboot_vc_row_template();

}