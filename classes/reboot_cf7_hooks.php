<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!class_exists('reboot_cf7_hooks')) {

    class reboot_cf7_hooks{

        function __construct()
        {

            // Disable Autop
            add_filter('wpcf7_autop_or_not', '__return_false');

            // Add shortcode support
            add_filter('wpcf7_form_elements', 'do_shortcode');

            // Add Cc and/or Bcc from theme via filter
            add_filter('wpcf7_mail_components', [$this, 'wpcf7_mail_components'], 10, 3);

        }

        /**
         * Add Cc and/or Bcc from theme via filter
         *
         * @param $components
         * @param $current_contact_form
         * @param $instance
         * @return mixed
         */
        function wpcf7_mail_components( $components, $current_contact_form, $instance){
            $cc = [];
            $bcc = [];

            if(REBOOT_AGENCY_EMAIL_AS_CC) {
                $cc[] = REBOOT_AGENCY_EMAIL;
            }

            if(REBOOT_AGENCY_EMAIL_AS_BCC) {
                $bcc[] = REBOOT_AGENCY_EMAIL;
            }

            $additional_header_emails = [
                'Cc' => apply_filters('reboot_cf7_cc', $cc),
                'Bcc' => apply_filters('reboot_cf7_bcc', $bcc),
            ];

            $additional_headers = [];
            foreach ($additional_header_emails as $header => $emails) {
                if(!empty($emails)) {
                    if(!is_array($emails)) {
                        $emails = [$emails];
                    }

                    $emails = implode(', ', $emails);

                    $additional_headers[] = sprintf("%s: %s", $header, $emails);
                }
            }

            if(!empty($additional_headers)) {
                $additional_headers = implode(" \n", $additional_headers);
                if(empty($components['additional_headers'])) {
                    $components['additional_headers'] = $additional_headers;
                } else {
                    $components['additional_headers'] .= "\n" . $additional_headers;
                }
            }

            return $components;
        }

    }

    new reboot_cf7_hooks();

}

