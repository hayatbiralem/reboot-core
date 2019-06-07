<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_cf7_hooks')) {

    class reboot_cf7_hooks
    {

        function __construct()
        {

            // Disable Autop
            add_filter('wpcf7_autop_or_not', '__return_false');

            // Add shortcode support
            add_filter('wpcf7_form_elements', 'do_shortcode');

            // Add Cc and/or Bcc from theme via filter
            add_filter('wpcf7_mail_components', [$this, 'add_cc_bcc'], 10, 3);

            // Override mail html headers & footer
            // add_filter('wpcf7_mail_html_header', [$this, 'wpcf7_mail_html_header'], 10, 2);
            // add_filter('wpcf7_mail_html_footer', [$this, 'wpcf7_mail_html_footer'], 10, 2);
            add_filter('wpcf7_special_mail_tags', [$this, 'wpcf7_special_mail_tags'], 30, 3);
            add_filter('wpcf7_mail_components', [$this, 'filter_mail_body'], 30, 3);

        }

        /**
         * Add Cc and/or Bcc from theme via filter
         *
         * @param $components
         * @param $current_contact_form
         * @param $instance
         * @return mixed
         */
        function add_cc_bcc($components, $current_contact_form, $instance)
        {
            $cc = [];
            $bcc = [];

            if (REBOOT_AGENCY_EMAIL_AS_CC) {
                $cc[] = REBOOT_AGENCY_EMAIL;
            }

            if (REBOOT_AGENCY_EMAIL_AS_BCC) {
                $bcc[] = REBOOT_AGENCY_EMAIL;
            }

            $additional_header_emails = [
                'Cc' => apply_filters('reboot_cf7_cc', $cc),
                'Bcc' => apply_filters('reboot_cf7_bcc', $bcc),
            ];

            $additional_headers = [];
            foreach ($additional_header_emails as $header => $emails) {
                if (!empty($emails)) {
                    if (!is_array($emails)) {
                        $emails = [$emails];
                    }

                    $emails = implode(', ', $emails);

                    $additional_headers[] = sprintf("%s: %s", $header, $emails);
                }
            }

            if (!empty($additional_headers)) {
                $additional_headers = implode(" \n", $additional_headers);
                if (empty($components['additional_headers'])) {
                    $components['additional_headers'] = $additional_headers;
                } else {
                    $components['additional_headers'] .= "\n" . $additional_headers;
                }
            }

            return $components;
        }

//        function wpcf7_mail_html_header($html, $instance)
//        {
//            if(!apply_filters('reboot_use_email_template', true)) {
//                return $html;
//            }
//
//            $header = reboot_email_template::header($html, $instance);
//            if(empty($header)) {
//                return $html;
//            }
//
//            return $header;
//        }
//
//        function wpcf7_mail_html_footer($html, $instance)
//        {
//            if(!apply_filters('reboot_use_email_template', true)) {
//                return $html;
//            }
//
//            $footer = reboot_email_template::footer($html);
//            if(empty($footer)) {
//                return $html;
//            }
//
//            return $footer;
//        }

        function wpcf7_special_mail_tags($output, $name, $html)
        {
            // $template_name = str_replace('reboot_', '', $name);
            $template_name = self::get_template_name($name);
            $method_name = 'template_' . $template_name;

            if (method_exists('reboot_email_template', $method_name)) {
                $template = call_user_func(['reboot_email_template', $method_name]);
            } else {
                $template = reboot_email_template::get_template($template_name);
            }

            if (empty($template)) {
                return $output;
            }

            return $template;
        }

        function filter_mail_body($components, $contact_form, $mail)
        {
            if (isset($components['body']) && !empty($components['body'])) {
                $replace = [];

                $self_closing_tags = [ '_table', '_table_end', '_preview', '_space', '_logo', '_banner', '_title', '_row', '_action', '_social'];
                $self_closing_shortcodes = reboot_parse_self_closing_shortcodes($self_closing_tags, $components['body']);
                $self_closing_shortcodes = !empty($self_closing_shortcodes) ? $self_closing_shortcodes : [];

                $enclosing_tags = ['_message', '_content', '_footer'];
                $enclosing_shortcodes = reboot_parse_enclosing_shortcodes($enclosing_tags, $components['body']);
                $enclosing_shortcodes = !empty($enclosing_shortcodes) ? $enclosing_shortcodes : [];

                $shortcodes = array_merge($self_closing_shortcodes, $enclosing_shortcodes);

                // $shortcodes = $self_closing_shortcodes;

                if(!empty($shortcodes)) {
                    foreach ($shortcodes as $shortcode) {
                        $template_name = self::get_template_name($shortcode['tag']);
                        $replace[] = [
                            'find' => $shortcode['full_match'],
                            'replace' => reboot_email_template::get_shortcode_template($template_name, $shortcode['params'])
                        ];
                    }
                }

                // reboot_dd($replace);

                if (!empty($replace)) {
                    $components['body'] = str_replace(
                        array_column($replace, 'find'),
                        array_column($replace, 'replace'),
                        $components['body']
                    );
                }
            }

            return $components;
        }

        function get_template_name($name)
        {
            return preg_replace('/^_/', '', $name); // remove first underscore
        }

    }

    new reboot_cf7_hooks();

}

