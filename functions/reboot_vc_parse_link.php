<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!function_exists('reboot_vc_parse_link')) {

    /**
     * Parse vc_link urls
     *
     * @param $url
     * @return array
     */
    function reboot_vc_parse_link($link)
    {
//        $url_args = [];
//
//        if(!empty($url)) {
//            $url_parts = array_filter(explode('|', $url));
//            foreach ($url_parts as $url_part) {
//                $url_part_parts = explode(':', $url_part);
//                $url_args[ $url_part_parts[0] ] = trim( urldecode($url_part_parts[1]) );
//            }
//        }
//
//        return $url_args;

        //parse link
        $link = trim( $link );
        $link = ( '||' === $link ) ? '' : $link;
        $link = vc_build_link( $link );
        $result = false;
        if ( strlen( $link['url'] ) > 0 ) {
            $result = [];
            $result['href'] = trim($link['url']);
            $result['href'] = apply_filters( 'vc_btn_a_href', $result['href'] );
            $result['title'] = trim($link['title']);
            $result['title'] = apply_filters( 'vc_btn_a_title', $result['title'] );
            $result['target'] = trim($link['target']);
            $result['rel'] = trim($link['rel']);
        }

        $attributes = [];
        if ( $result ) {
            $attributes[] = 'href="' . $result['href'] . '"';
            if ( ! empty( $result['title'] ) ) {
                $attributes[] = 'title="' . esc_attr( $result['title'] ) . '"';
            }
            if ( ! empty( $result['target'] ) ) {
                $attributes[] = 'target="' . esc_attr( $result['target'] ) . '"';
            }
            if ( ! empty( $result['rel'] ) ) {
                $attributes[] = 'rel="' . esc_attr( $result['rel'] ) . '"';
            }

            $result['attributes'] = implode(' ', $attributes);
        }

        return $result;
    }

}