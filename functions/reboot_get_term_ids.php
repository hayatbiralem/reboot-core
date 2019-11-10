<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_term_ids')) {

    /**
     * Get post ids by given post type
     *
     * @param string $post_type
     *
     * @return array
     */
    function reboot_get_term_ids($taxonomy = 'category')
    {
        $terms = get_terms( array(
            'taxonomy' => $taxonomy ?: 'category',
            'hide_empty' => false,
        ) );

        $subtype = array();
        if($terms) {
            foreach ($terms as $term) {
                $subtype[ $term->name ] = $term->term_id;
            }
        }

        return $subtype;
    }

}