<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!defined('REBOOT_CHILD_TGMPA_PATH')) {
    // exit('We need the Reboot Core plugin!');
    return; // we do not want to be rude :)
}

return [

    [
        'name' => 'ACF PRO',
        'slug' => 'advanced-custom-fields-pro',
        'source' => REBOOT_CHILD_TGMPA_PATH . 'advanced-custom-fields-pro.zip',
        'required' => false,
        'version' => '',
        'force_activation' => false,
        'force_deactivation' => false,
        'external_url' => '',
        'is_callable' => '',
    ],

    [
        'name' => 'ACF Repeater',
        'slug' => 'acf-repeater',
        'source' => REBOOT_CHILD_TGMPA_PATH . 'acf-repeater.zip',
        'required' => false,
        'version' => '',
        'force_activation' => false,
        'force_deactivation' => false,
        'external_url' => '',
        'is_callable' => '',
    ],

    [
        'name' => 'WPBakery Page Builder (Visual Composer) Clipboard',
        'slug' => 'vc_clipboard',
        'source' => REBOOT_CHILD_TGMPA_PATH . 'vc_clipboard.zip',
        'required' => false,
        'version' => '',
        'force_activation' => false,
        'force_deactivation' => false,
        'external_url' => '',
        'is_callable' => '',
    ],

    [
        'name' => 'WP Fastest Cache Premium',
        'slug' => 'wp-fastest-cache-premium',
        'source' => REBOOT_CHILD_TGMPA_PATH . 'wp-fastest-cache-premium.zip',
        'required' => false,
        'version' => '',
        'force_activation' => false,
        'force_deactivation' => false,
        'external_url' => '',
        'is_callable' => '',
    ],

//    [
//        'name' => 'Ultimate Addons for Visual Composer',
//        'slug' => 'Ultimate_VC_Addons',
//        'source' => REBOOT_CHILD_TGMPA_PATH . 'Ultimate_VC_Addons.zip',
//        'required' => false,
//        'version' => '',
//        'force_activation' => false,
//        'force_deactivation' => false,
//        'external_url' => '',
//        'is_callable' => '',
//    ],

//    [
//        'name' => 'Yoast SEO',
//        'slug' => 'wordpress-seo',
//        'is_callable' => '',
//        'required' => false,
//        'force_activation' => false,
//    ],

];