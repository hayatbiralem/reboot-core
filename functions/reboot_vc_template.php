<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

// Show template with specified ID
if ( !function_exists( 'reboot_vc_template' ) ) {

    function reboot_vc_template($id) {
        $layout = get_post($id);
        if (!empty($layout)) {
            global $reboot_vc_template_inside;
            $reboot_vc_template_inside = true;
            $content = shortcode_unautop(trim($layout->post_content));
            // In WordPress 4.9 post content wrapped with <p>...</p>
            // and shortcode_unautop() not remove it - do it manual
            if (strpos($content, '<p>[vc_row') !== false || strpos($content, '<p>[vc_section') !== false) {
                $content = str_replace(
                    array('<p>[vc_row', '[/vc_row]</p>', '<p>[vc_section', '[/vc_section]</p>'),
                    array('[vc_row', '[/vc_row]', '[vc_section', '[/vc_section]'),
                    $content);
            }
            printf('<div class="vc-template-wrapper">%s</div>', do_shortcode( reboot_replace_special_vars($content) ));
            $reboot_vc_template_inside = false;
            // Add VC custom styles to the inline CSS
            $vc_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
            if ( !empty( $vc_custom_css ) ) {
                printf(
                    '<style type="text/css" data-type="vc-template-css">%s</style>',
                    strip_tags($vc_custom_css)
                );
            }
        }
    }

}