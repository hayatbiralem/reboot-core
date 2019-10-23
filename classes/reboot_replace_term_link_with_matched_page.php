<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_replace_term_link_with_matched_page')) {

    class reboot_replace_term_link_with_matched_page
    {

        function __construct()
        {
            add_filter('term_link', [$this, 'filter'], 10, 3);
            add_action('template_redirect', [$this, 'redirect']);
        }

        function filter( $url, $term, $taxonomy ) {
            $page = get_page_by_title($term->name);
            if($page) {
                return get_permalink($page);
            }
            return $url;
        }

        function redirect() {
            if ( is_archive() ) {
                $queried_object = get_queried_object();
                if(isset($queried_object->name)) {
                    $page = get_page_by_title($queried_object->name);
                    if($page) {
                        wp_redirect( get_permalink($page) );
                        die;
                    }
                }
            }
        }

    }

    new reboot_replace_term_link_with_matched_page();

}
