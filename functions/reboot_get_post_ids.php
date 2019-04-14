<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_post_ids')) {

    /**
     * Get post ids by given post type
     *
     * @param string $post_type
     *
     * @return array
     */
    function reboot_get_post_ids($post_type = 'post', $key_prefix = '')
    {
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'order'=> 'ASC',
            'orderby' => 'title'
        );
        $posts = get_posts($args);
        $subtype = array();
        if ( $posts ) {
            foreach ( $posts as $post ) {
                $subtype[ $key_prefix . $post->post_title ] = $post->ID;
            }
        }

        return $subtype;
    }

}