<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_email_template')) {

    class reboot_email_template
    {

        static $css = [
            'h1 {margin: 0 0 10px 0; font-family: sans-serif; font-size: 17px; line-height: 24px; font-weight: bold;}',
            'h1:last-child {margin-bottom: 0;}',

            'p {margin-left: 0; margin-right: 0; margin-top: 0; margin-bottom: 10px;}',
            'p:last-child {margin-bottom: 0;}',
        ];

        function __construct()
        {
            // no need
        }

        static function get_template($template_name = '', $atts = [])
        {

            if (empty($template_name)) {
                return null;
            }

            $output = self::read_template($template_name, $atts);

            if(empty($output)) {
                return null;
            }

            return $output;
        }

        static function get_shortcode_template($template_name = '', $atts = [])
        {
            if (empty($template_name)) {
                return null;
            }

            return self::get_template('_' . $template_name, $atts);
        }

        static function read_template($template_name = '', $atts = [])
        {
            if (empty($template_name)) {
                return null;
            }

            $file = REBOOT_CORE_PATH . 'classes/reboot_email_template/views/' . $template_name . '.php';
            if (!file_exists($file)) {
                return null;
            }

            $atts = apply_filters('reboot_email_template_read_template_atts', $atts, $template_name);

            ob_start();
            if($template_name != 'html') {
                echo "\n\n";
            }
            include $file;
            return ob_get_clean();
        }

        static function template_html($atts = [])
        {
            $lang_atts = $atts['lang_atts'] ?: '';
            $title = $atts['title'] ?: '';

            if (empty($lang_atts) && class_exists('WPCF7_Submission')) {
                if ($submission = WPCF7_Submission::get_instance()) {
                    $contact_form = $submission->get_contact_form();
                    $locale = $contact_form->locale();
                    $lang_atts = sprintf(' %s',
                        wpcf7_format_atts(array(
                            'dir' => wpcf7_is_rtl($locale) ? 'rtl' : 'ltr',
                            'lang' => str_replace('_', '-', $locale),
                        ))
                    );
                }
            }

            if (empty($title)) {
                /** @var WPCF7_Mail $cf7_instance */
                $cf7_instance = WPCF7_Mail::get_current();
                if ($cf7_instance) {
                    $title = esc_html($cf7_instance->get('subject', true));
                }
            }

            $defaults = [
                '{lang_atts}' => $lang_atts,
                '{title}' => $title,
            ];

            $atts = shortcode_atts($defaults, $atts);

            return self::get_template('html', $atts);
        }

        static function template_logo($atts = [])
        {
            $blog_title = get_bloginfo('title');

            $defaults = [
                'logo_link' => home_url('/'),
                'logo_title' => $blog_title,
                'logo_alt' => $blog_title,
                'logo_image' => REBOOT_CORE_URL . 'classes/reboot_email_template/images/logo.png',
                'logo_width' => '240',
            ];

            $atts = shortcode_atts($defaults, $atts);

            return self::get_template('logo', $atts);
        }

        static function template_banner($atts = [])
        {
            $blog_description = get_bloginfo('description');

            $defaults = [
                'banner_link' => home_url('/'),
                'banner_title' => $blog_description,
                'banner_alt' => $blog_description,
                'banner_image' => REBOOT_CORE_URL . 'classes/reboot_email_template/images/banner.jpg',
            ];

            $atts = shortcode_atts($defaults, $atts);

            return self::get_template('banner', $atts);
        }

        static function template_footer($atts = [])
        {
            $defaults = [
                'facebook_link' => '#',
                'twitter_link' => '#',
                'instagram_link' => '#',
                'youtube_link' => '#',
                'footer_text' => sprintf('<a target="_blank" href="%s">%s</a>', home_url('/'), get_bloginfo('name')),
            ];

            $atts = shortcode_atts($defaults, $atts);

            return self::get_template('footer', $atts);
        }

        static function replace($html, $atts = [])
        {
            if (empty($html)) {
                return null;
            }

            if(empty($atts)) {
                return $html;
            }

            $replace = [];
            foreach ($atts as $key => $attr) {
                // $replace[ sprintf('{%s}', $key) ] = apply_filters("reboot_email_template_{$key}", $attr);
                $replace[ sprintf('{%s}', $key) ] = $attr;
            }

            $html = str_replace(
                array_keys($replace),
                array_values($replace),
                $html
            );

            return $html;
        }

        static function inline_css($content, $css = [], $wpautop = true)
        {
            if($wpautop) {
                $content = wpautop($content);
            }

            $css = array_merge(self::$css, $css);

            if(empty($css)) {
                return $content;
            }

            $css = implode(' ', $css);

            if(!class_exists('\Pelago\Emogrifier')) {
                require_once REBOOT_CORE_PATH . 'classes/reboot_email_template/lib/Emogrifier/Emogrifier.php';
            }

            try {
                $emogrifier = new \Pelago\Emogrifier(sprintf('<html><body>%s</body></html>', $content), $css);
                return $emogrifier->emogrifyBodyContent();
            } catch (\Exception $e) {
                return __('Error: %s', $e->getMessage());
            }
        }

        static function build_table_content($data)
        {
            $template = [];
            $template[] = "[_title text=\"{$data['title']}\"]";

            $template[] = "[_table]";
            foreach ($data['rows'] as $row) {
                $template[] = "[_row title=\"{$row['title']}\" value=\"{$row['value']}\"]";
            }
            $template[] = "[_table_end]";

            return implode(" \n", $template);
        }
    }

    new reboot_email_template();

}

