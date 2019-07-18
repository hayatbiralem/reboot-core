<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_response_file')) {

    function reboot_response_file($attachment_id = '', $force_download = false)
    {
        // get file data
        if(empty($attachment_id)) {
            $attachment_id = $_GET['attachment_id'];
        }
        
        $attachment_url = wp_get_attachment_url($attachment_id);

        if (!$attachment_url) {
            return;
        }

        // clean the file url
        $file_url = stripslashes(trim($attachment_url));

        // get filename
        $file_name = basename($attachment_url);

        // get file extension
        $file_extension = (pathinfo($file_name))['extension'];

        // security check
        $file_name = strtolower($file_url);

        $wp_mime_types = wp_get_mime_types();
        $wp_mime_type_extensions = [];
        foreach ($wp_mime_types as $extensions => $wp_mime_type) {
            $extensions = explode('|', $extensions);
            $wp_mime_type_extensions = array_merge($wp_mime_type_extensions, $extensions);
        }

        $whitelist = apply_filters("reboot_response_file_allowed_file_types", $wp_mime_type_extensions);

//        if (!in_array(end(explode('.', $file_name)), $whitelist)) {
//            exit('Invalid file!');
//        }

        if (!in_array($file_extension, $whitelist)) {
            exit('Invalid file!');
        }

        if (strpos($file_url, '.php') == true) {
            die("Invalid file!");
        }

        $file_new_name = $file_name;

        if($force_download) {
            $content_type = "application/force-download";
        } else {
            $content_type = get_post_mime_type( $attachment_id );
        }

        $content_type = apply_filters("reboot_response_file_content_type", $content_type, $file_extension);

        header("Expires: 0");
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header('Cache-Control: pre-check=0, post-check=0, max-age=0', false);
        header("Pragma: no-cache");
        header("Content-type: {$content_type}");
        header("Content-Disposition:attachment; filename={$file_new_name}");
        header("Content-Type: application/force-download");

        readfile("{$file_url}");
        exit();
    }

}