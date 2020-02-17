<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_autocomplete')) {

    class reboot_vc_autocomplete
    {
        private static $collection = [];

        /**
         * @param $shortcode
         * @param $param
         * @param string|array $options
         */
        public static function add($shortcode, $param, $options = 'post')
        {
            $key = self::get_key($shortcode, $param);

            if (isset(self::$collection[$key])) {
                return;
            }

            if (!is_array($options)) {
                $options = [
                    'post_type' => $options,
                ];
            }

            if (isset($options['post_type']) && !empty($options['post_type'])) {
                self::add_post_type($shortcode, $param, $options);
            }

            self::$collection[$key] = [
                'shortcode' => $shortcode,
                'param' => $param,
                'options' => $options
            ];
        }

        public static function add_post_type($shortcode, $param, $options)
        {
            $suggester = self::get_post_type_suggester($options['post_type']);
            self::add_filter("vc_autocomplete_{$shortcode}_{$param}_callback", $suggester);

            add_filter("vc_autocomplete_{$shortcode}_{$param}_render", 'reboot_vc_autocomplete::suggester_render_post_type');
        }

        public static function get_post_type_suggester($post_type = 'post')
        {
//            return function ($query) use ($post_type) {
//                global $wpdb;
//                $post_id = (int)$query;
//                $post_results = $wpdb->get_results($wpdb->prepare("SELECT a.ID AS id, a.post_title AS title FROM {$wpdb->posts} AS a WHERE a.post_type = '{$post_type}' AND a.post_status != 'trash' AND ( a.ID = '%d' OR a.post_title LIKE '%%%s%%' )", $post_id > 0 ? $post_id : -1, stripslashes($query), stripslashes($query)), ARRAY_A);
//                $results = array();
//                if (is_array($post_results) && !empty($post_results)) {
//                    foreach ($post_results as $value) {
//                        $data = array();
//                        $data['value'] = $value['id'];
//                        $data['label'] = $value['title'];
//                        $results[] = $data;
//                    }
//                }
//                return $results;
//            };


            return function ($query) use ($post_type) {
                $data = array();
                $args = array(
                    's' => $query,
                    'post_type' => $post_type,
                );
                $args['vc_search_by_title_only'] = true;
                $args['numberposts'] = - 1;
                if ( 0 === strlen( $args['s'] ) ) {
                    unset( $args['s'] );
                }
                add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
                $posts = get_posts( $args );
                if ( is_array( $posts ) && ! empty( $posts ) ) {
                    foreach ( $posts as $post ) {
                        $data[] = array(
                            'value' => $post->ID,
                            'label' => $post->post_title,
                            'group' => $post->post_type,
                        );
                    }
                }

                return $data;
            };
        }

        function suggester_render_post_type($query)
        {
            $query = trim($query['value']);

            // get value from requested
            if (!empty($query)) {
                $post_object = get_post((int)$query);
                if (is_object($post_object)) {
                    $post_title = $post_object->post_title;
                    $post_id = $post_object->ID;
                    $data = array();
                    $data['value'] = $post_id;
                    $data['label'] = $post_title;
                    return !empty($data) ? $data : false;
                }
                return false;
            }
            return false;
        }

        public static function add_filter($hook, $closure, $priority = 10, $params = 1)
        {
            add_filter($hook, $closure, $priority, $params);
        }

        public static function get_key($shortcode, $param)
        {
            return sprintf('%s_%s', $shortcode, $param);
        }

    }

}
