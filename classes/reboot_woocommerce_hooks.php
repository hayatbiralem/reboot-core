<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_woocommerce_hooks')) {

    class reboot_woocommerce_hooks
    {

        function __construct()
        {
            add_filter( 'woocommerce_terms_is_checked', [$this, 'check_wc_terms'], 10 );
            add_filter( 'woocommerce_terms_is_checked_default', [$this, 'check_wc_terms'], 10 );
        }

        function check_wc_terms( $terms_is_checked ) {
            return true;
        }

    }

    new reboot_woocommerce_hooks();

}
