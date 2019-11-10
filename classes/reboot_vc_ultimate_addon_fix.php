<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_ultimate_addon_fix')) {

    class reboot_vc_ultimate_addon_fix
    {
        public function __construct()
        {
            add_filter('ultimate_front_scripts_post_content', [$this, 'ultimate_front_scripts_post_content'], 10, 2);
        }

        public function ultimate_front_scripts_post_content($post_content, $post)
        {

            if (has_shortcode($post_content, 'reboot_template')) {
                $shortcodes = reboot_parse_self_closing_shortcodes(['reboot_template'], $post_content);
                if (!empty($shortcodes)) {
                    $replace = [];
                    foreach ($shortcodes as $shortcode) {
                        if (!isset($replace[$shortcode['full_match']])) {
                            if (isset($shortcode['params']['id']) && !empty($shortcode['params']['id'])) {
                                $block = get_post($shortcode['params']['id']);
                                if ($block) {
                                    $replace[$shortcode['full_match']] = $block->post_content;
                                }
                            }
                        }
                    }
                    if (!empty($replace)) {
                        $post_content = str_replace(
                            array_keys($replace),
                            array_values($replace),
                            $post_content
                        );
                    }
                }
            }

            if (strpos($post_content, ' reboot_template=') !== false) {
                $shortcodes = reboot_parse_self_closing_shortcodes(reboot_vc_row_template::$tags, $post_content);
                // die( var_export($shortcodes, true) );
                if (!empty($shortcodes)) {
                    $replace = [];
                    foreach ($shortcodes as $shortcode) {
                        if (!isset($replace[$shortcode['full_match']])) {
                            if (isset($shortcode['params']['reboot_template']) && !empty($shortcode['params']['reboot_template'])) {
                                $block = get_post($shortcode['params']['reboot_template']);
                                if ($block) {
                                    $replace[$shortcode['full_match']] = $block->post_content;
                                }
                            }
                        }
                    }
                    if (!empty($replace)) {
                        $post_content = str_replace(
                            array_keys($replace),
                            array_values($replace),
                            $post_content
                        );
                    }
                }
            }

            return $post_content;
        }

    }

    new reboot_vc_ultimate_addon_fix();

}