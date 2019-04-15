<?php

/**
 * Plugin Name: Reboot Core
 * Description: Core plugin for Reboot
 * Version:     4.0.0
 * Author:      Reboot
 * Author URI:  https://reboot.com.tr
 * Text Domain: reboot-core
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!class_exists('REBOOT_CORE')) {

    define('REBOOT_CORE_VERSION', '4.0.0');

    define('REBOOT_CORE_PATH', plugin_dir_path(__FILE__));
    define('REBOOT_CORE_URL', plugin_dir_url(__FILE__));

    define('REBOOT_ASSETS_VERSION', REBOOT_CORE_VERSION);
    define('REBOOT_ASSETS_PATH', REBOOT_CORE_PATH . 'assets/');
    define('REBOOT_ASSETS_URL', REBOOT_CORE_URL . 'assets/');

    define('REBOOT_NONCE_KEY', '1c1d1bdd7e6c24057ef271c2bd5e3d6c' ); // You can use md5_file( __FILE__ ) for new cool nonce key ;)
    define('REBOOT_TEXT_DOMAIN', 'reboot');
    // REBOOT_CHILD_TEXT_DOMAIN will be defined in config

    define('REBOOT_TGMPA_PATH', REBOOT_CORE_PATH . 'tgmpa/');
    define('REBOOT_TGMPA_PLUGINS_PATH', REBOOT_TGMPA_PATH . 'plugins/');

    define('REBOOT_DIRECTORY_NAME', 'reboot');

    define('REBOOT_TEMPLATE_PATH', trailingslashit(get_template_directory()));
    define('REBOOT_TEMPLATE_URL', trailingslashit(get_template_directory_uri()));

    define('REBOOT_CHILD_PATH', trailingslashit(get_stylesheet_directory()));
    define('REBOOT_CHILD_URL', trailingslashit(get_stylesheet_directory_uri()));

    define('REBOOT_IS_CHILD', REBOOT_TEMPLATE_PATH != REBOOT_CHILD_PATH ? true : false);

    define('REBOOT_SHORTCODES_PATH', REBOOT_CORE_PATH . 'shortcodes/');
    define('REBOOT_SHORTCODES_URL', REBOOT_CORE_URL . 'shortcodes/');

    define('REBOOT_CHILD_TGMPA_PATH', REBOOT_CHILD_PATH . REBOOT_DIRECTORY_NAME . '/tgmpa/');
    define('REBOOT_CHILD_TGMPA_PLUGINS_PATH', REBOOT_CHILD_TGMPA_PATH . 'plugins/');

    require REBOOT_CORE_PATH . 'config.php';
    require REBOOT_CORE_PATH . 'bootstrap.php';

    class REBOOT_CORE {
        static function getVersion(){
            return REBOOT_CORE_VERSION;
        }
    }

    new REBOOT_CORE;

}