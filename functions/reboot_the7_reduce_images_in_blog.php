<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_the7_reduce_images_in_blog')) {

    function reboot_the7_reduce_images_in_blog($str, $image_size = 'medium', $image_size_offset_size = '', $image_size_offset_number = 2)
    {
        if(empty($image_size)) {
            return $str;
        }

        $new_str = $str;

        $re = '/<article[^>]*>.*?<\/article>/is';
        if (preg_match_all($re, $str, $article_matches, PREG_SET_ORDER, 0)) {
            // return count($article_matches);
            foreach ($article_matches as $index => $article_match) {

                if(!empty($image_size_offset_size) && $index >= ($image_size_offset_number - 1)) {
                    $image_size = $image_size_offset_size;
                }

                $image_size = reboot_maybe_custom_image_dimension($image_size);

                $replace = [];
                $re_post_id = '/class="[^"]+post-(\d+)[^"]+"/m';
                if (preg_match_all($re_post_id, $article_match[0], $post_id_matches, PREG_SET_ORDER, 0)) {
                    $post_id = $post_id_matches[0][1];
                    if (has_post_thumbnail($post_id)) {
                        $re_src = '/(data-src="[^"]+")/m';
                        if (preg_match_all($re_src, $article_match[0], $src_matches, PREG_SET_ORDER, 0)) {
                            $thumbnail_id = get_post_thumbnail_id($post_id);
                            $src = wp_get_attachment_image_src($thumbnail_id, $image_size);
                            $replace[$src_matches[0][1]] = sprintf('data-src="%s"', $src[0]);

                            $atts = [
                                'width' => $src[1],
                                'height' => $src[2],
                            ];

                            foreach ($atts as $attr => $value) {
                                $re_dimension = '/'.$attr.'="[^"]+"/m';
                                if (preg_match_all($re_dimension, $article_match[0], $size_matches, PREG_SET_ORDER, 0)) {
                                    $replace[$size_matches[0][0]] = sprintf('%s="%s"', $attr, $value);
                                }
                            }
                        }

                        $re_srcset = '/(data-srcset="[^"]+")/m';
                        if (preg_match_all($re_srcset, $article_match[0], $srcset_matches, PREG_SET_ORDER, 0)) {
                            $thumbnail_id = get_post_thumbnail_id($post_id);
                            $srcset = wp_get_attachment_image_srcset($thumbnail_id, $image_size);
                            $replace[$srcset_matches[0][1]] = !empty($srcset) ? sprintf('data-srcset="%s"', $srcset) : '';
                        }
                    }
                }

                if (!empty($replace)) {
                    $new_str = str_replace(
                        $article_match[0],
                        str_replace(
                            array_keys($replace),
                            array_values($replace),
                            $article_match[0]
                        ),
                        $new_str
                    );
                }
            }
        }

        return $new_str;
    }

}