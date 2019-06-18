<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_post_mime_types')) {

    class reboot_post_mime_types
    {

        function __construct()
        {
            add_filter('post_mime_types', [$this, 'post_mime_types'], 10, 1);
        }

        public function post_mime_types($post_mime_types)
        {
            $post_mime_types['application/msword'] = array(__('DOCs', REBOOT_CORE_TEXT_DOMAIN), __('Manage DOCs', REBOOT_CORE_TEXT_DOMAIN), _n_noop('DOC <span class="count">(%s)</span>', 'DOC <span class="count">(%s)</span>', REBOOT_CORE_TEXT_DOMAIN));
            $post_mime_types['application/vnd.ms-excel'] = array(__('XLSs', REBOOT_CORE_TEXT_DOMAIN), __('Manage XLSs', REBOOT_CORE_TEXT_DOMAIN), _n_noop('XLS <span class="count">(%s)</span>', 'XLSs <span class="count">(%s)</span>', REBOOT_CORE_TEXT_DOMAIN));
            $post_mime_types['application/pdf'] = array(__('PDFs', REBOOT_CORE_TEXT_DOMAIN), __('Manage PDFs', REBOOT_CORE_TEXT_DOMAIN), _n_noop('PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>', REBOOT_CORE_TEXT_DOMAIN));
            $post_mime_types['application/zip'] = array(__('ZIPs', REBOOT_CORE_TEXT_DOMAIN), __('Manage ZIPs', REBOOT_CORE_TEXT_DOMAIN), _n_noop('ZIP <span class="count">(%s)</span>', 'ZIPs <span class="count">(%s)</span>', REBOOT_CORE_TEXT_DOMAIN));

            return $post_mime_types;
        }

    }

    new reboot_post_mime_types();

}
