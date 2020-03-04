<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_get_attachments_by_filename')) {

    function reboot_get_attachments_by_filename( $post_name ) {
        global $wpdb;
        $attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE guid LIKE '%s' AND post_type = 'attachment';", '%/' . $post_name . '.%' ));
        return $attachments;
    }

}