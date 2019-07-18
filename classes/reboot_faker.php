<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_faker')) {

    class reboot_faker
    {

        private static $required_post_fields = ['post_type', 'post_title'];
        private static $required_term_fields = ['term', 'taxonomy'];

        static function posts()
        {
            $file = locate_template(array('reboot/posts.json'));

            if (empty($file)) {
                return;
            }

            $posts = file_get_contents($file);

            if(empty($posts)) {
                return;
            }

            $posts = json_decode($posts, true);

            $posts = apply_filters('reboot_faker_posts', $posts);

            if (empty($posts)) {
                return;
            }

            $report = [];

            foreach ($posts as $post) {
                $report[] = self::insert_post($post);
            }

            if(apply_filters('reboot_faker_die', true)) {
                reboot_dd($report);
            }
        }

        static function terms()
        {
            $file = locate_template(array('reboot/terms.json'));

            if (empty($file)) {
                return;
            }

            $terms = file_get_contents($file);

            if(empty($terms)) {
                return;
            }

            $terms = json_decode($terms, true);

            $terms = apply_filters('reboot_faker_terms', $terms);

            if (empty($terms)) {
                return;
            }

            $report = [];

            foreach ($terms as $term) {
                $report[] = self::insert_term($term);
            }

            if(apply_filters('reboot_faker_die', true)) {
                reboot_dd($report);
            }
        }

        static function insert_post($post)
        {
            $missing = [];

            foreach (self::$required_post_fields as $required_field) {
                if(!isset($post[$required_field]) || empty($post[$required_field])) {
                    $missing[] = $required_field;
                    break;
                }
            }

            if(!empty($missing)) {
                return sprintf( __("Missing: %s"), implode(", ", $missing));
            }

            $exists = get_page_by_title($post['post_title'], OBJECT, $post['post_type']);

            if($exists) {
                return sprintf( __('Post exists: [%1$s](%2$s)'), $post['post_title'], get_permalink($exists->ID));
            }

            $id = wp_insert_post($post);

            if(!$id) {
                return sprintf( __("Couldn't create: %s"), $post['post_title']);
            }

            return get_permalink($id);
        }

        static function insert_term($term)
        {
            $missing = [];

            foreach (self::$required_term_fields as $required_field) {
                if(!isset($term[$required_field]) || empty($term[$required_field])) {
                    $missing[] = $required_field;
                    break;
                }
            }

            if(!empty($missing)) {
                return sprintf( __("Missing: %s"), implode(", ", $missing));
            }

            $exists = term_exists( $term['term'], $term['taxonomy'], isset($term['args']['parent']) ? $term['args']['parent'] : 0 );

            if($exists) {
                return sprintf( __('Term exists: [%1$s](%2$s)'), $term['term'], get_permalink($term['term'], $term['taxonomy']));
            }

            $result = wp_insert_term($term['term'], $term['taxonomy'], isset($term['args']) ? $term['args'] : null);

            if(is_wp_error($result)) {
                return sprintf( __("Couldn't create: %s"), $term['post_title']);
            }

            return get_term_link($result, $term['taxonomy']);
        }

        static function cities_as_term($taxonomy, $lang = 'tr')
        {
            $data = file_get_contents( REBOOT_CORE_PATH . 'data/cities/turkey/'.$lang.'.json');

            if(empty($data)) {
                return;
            }

            $data = json_decode($data, true);

            if (empty($data)) {
                return;
            }

            $terms = [];
            foreach ($data as $datum) {
                $terms[] = [
                    'term' => $datum['city'],
                    'taxonomy' => $taxonomy,
                ];
            }

            $report = [];

            foreach ($terms as $term) {
                $report[] = self::insert_term($term);
            }

            if(apply_filters('reboot_faker_die', true)) {
                reboot_dd($report);
            }
        }

    }

    new reboot_faker();

}

