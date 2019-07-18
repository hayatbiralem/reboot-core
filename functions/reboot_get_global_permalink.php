<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_get_global_permalink')) {

    /**
     * Get global permalink (for default language)
     *
     * @return string
     */
    function reboot_get_global_permalink($post_id = null, $post_type = 'post')
    {
//        $wpml_object_id = apply_filters( 'wpml_object_id', $post_id, $post_type );
//        $permalink = apply_filters( 'wpml_permalink', get_permalink($wpml_object_id), reboot_get_default_lang() );
//        // $permalink = get_permalink($wpml_object_id);
//        return $permalink;
        return get_permalink($post_id);
    }

}