<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_the7_blog_improvements')) {

    class reboot_vc_the7_blog_improvements
    {

        public static $tags = [
            'dt_blog_masonry',
            'dt_blog_list',
        ];

        /**
         * Constructor
         */
        public function __construct()
        {
            add_action( 'vc_after_init', array($this, 'add_params'), 10, 0 );

//            foreach (self::$tags as $tag) {
//                add_filter( "shortcode_atts_{$tag}", array($this, 'filter'), 999, 4 );
//            }

            add_action( 'do_shortcode_tag', array($this, 'filter_final_output'), 20, 4 );
        }

        public function add_params(){

            // params
            $params = array(

                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Genel Özellikler', REBOOT_CHILD_TEXT_DOMAIN),
                    'param_name' => 'reboot_blog_style',
                    'value' => [
                        __('Mini blog', REBOOT_CORE_TEXT_DOMAIN) => 'blog-shortcode--mini',
                        __('İlk yazının görseli büyük', REBOOT_CORE_TEXT_DOMAIN) => 'blog-shortcode--first-is-big',
                    ],
                    'std' => '',
                    'group' => sprintf(__('%s Improvements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                ),

                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Mobil Yerleşim', REBOOT_CHILD_TEXT_DOMAIN),
                    'param_name' => 'reboot_blog_style_mobile',
                    'value' => [
                        __('Tek sütun', REBOOT_CORE_TEXT_DOMAIN) => 'blog-shortcode--default',
                        __('İki sütun', REBOOT_CORE_TEXT_DOMAIN) => 'blog-shortcode--two-columns-at-mobile',
                        __('Carousel', REBOOT_CORE_TEXT_DOMAIN) => 'blog-shortcode--carousel-at-mobile',
                    ],
                    'std' => 'blog-shortcode--default',
                    'group' => sprintf(__('%s Improvements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                ),

                array(
                    'type' => 'textfield',
                    'heading' => __( 'Görsel Boyutu', REBOOT_CHILD_TEXT_DOMAIN),
                    'description' => __( 'thumbnail, medium, large, full or {width}x{height}', REBOOT_CHILD_TEXT_DOMAIN),
                    'param_name' => 'reboot_image_size',
                    'std' => '',
                    'group' => sprintf(__('%s Improvements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                ),


                array(
                    'type' => 'textfield',
                    'heading' => __( 'Takip Eden Görsel Boyutu', REBOOT_CHILD_TEXT_DOMAIN),
                    'description' => __( 'thumbnail, medium, large, full or {width}x{height}', REBOOT_CHILD_TEXT_DOMAIN),
                    'param_name' => 'reboot_image_size_offset_size',
                    'std' => '',
                    'group' => sprintf(__('%s Improvements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                    'dependency' => [
                        'element' => 'reboot_image_size',
                        'not_empty' => true
                    ]
                ),


                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Takip Eden Görsel Başlangıç No', REBOOT_CHILD_TEXT_DOMAIN),
                    'param_name' => 'reboot_image_size_offset_number',
                    'value' => [
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8',
                        '9' => '9',
                        '10' => '10',
                    ],
                    'std' => '2',
                    'group' => sprintf(__('%s Improvements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY),
                    'dependency' => [
                        'element' => 'reboot_image_size_offset_size',
                        'not_empty' => true
                    ]
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

            if (isset($out['reboot_image_size']) && !empty($out['reboot_image_size'])) {

            }

            return $out;
        }

        public function filter_final_output($output, $tag, $attr, $m){
            if(!in_array($tag, self::$tags)) {
                return $output;
            }

            if(!isset($attr['reboot_image_size']) || empty($attr['reboot_image_size'])) {
                return $output;
            }

            if(isset($attr['reboot_blog_style_mobile']) && !empty($attr['reboot_blog_style_mobile'])) {
                $output = str_replace(
                    ' blog-shortcode ',
                    sprintf(' blog-shortcode %s ', $attr['reboot_blog_style_mobile']),
                    $output
                );
            }

            if(isset($attr['reboot_blog_style']) && !empty($attr['reboot_blog_style'])) {
                $output = str_replace(
                    ' blog-shortcode ',
                    sprintf(' blog-shortcode %s ', implode(' ', explode(',', $attr['reboot_blog_style']))),
                    $output
                );
            }

            return reboot_the7_reduce_images_in_blog($output, $attr['reboot_image_size'], $attr['reboot_image_size_offset_size'] ?: '', $attr['reboot_image_size_offset_number'] ?: 2);
        }

    }

    new reboot_vc_the7_blog_improvements();

}