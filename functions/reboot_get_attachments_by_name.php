<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_get_attachments_by_name')) {

    function reboot_get_attachments_by_name( $post_name ) {
//        $args           = array(
//            'posts_per_page' => -1,
//            'post_type'      => 'attachment',
//            'name'           => trim( $post_name ),
//        );
//
//        $attachments = new WP_Query( $args );
//
//        if ( ! $attachments || ! isset( $attachments->posts, $attachments->posts[0] ) ) {
//            return false;
//        }
//
//        return $attachments;


        global $wpdb;
        $attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name LIKE '%s' AND post_type = 'attachment';", $post_name . '%' ));
        return $attachments;
    }

}