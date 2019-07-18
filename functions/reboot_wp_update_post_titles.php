<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_wp_update_post_titles')) {

    /**
     * Update Post Titles
     *
     * Sample pattern and replacement are:
     *
     * $pattern = '/(\d{4}) (.*)/m';
     * $replacement = '$2 $1';
     */

    function reboot_wp_update_post_titles($post_type = 'post', $pattern = '', $replacement = '', $request_param_to_check = 'reboot-wp-updates-post-title'){

        if(empty($pattern) || empty($request_param_to_check)) {
            return;
        }

        if(is_admin() && isset($_REQUEST[$request_param_to_check])) {

            $posts = get_posts([
                'post_type' => $post_type,
                'post_status' => 'publish',
                'posts_per_page' => -1,
            ]);

            foreach ($posts as $post) {
                if(preg_match($pattern, $post->post_title)) {
                    $new_title = preg_replace($pattern, $replacement, $post->post_title);
                    if(!empty($new_title)) {
                        $updated = wp_update_post([
                            'ID' => $post->ID,
                            'post_title' => $new_title,
                            'post_name' => sanitize_title($new_title),
                        ]);

                        echo ($updated ? 'Updated: ' : 'Not updated: ') . $new_title . "<br>";
                    } else {
                        echo 'Empty new title for: ' . get_permalink($post) . "<br>";
                    }
                }
            }

            die;

        }

    }

}