<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

/**
 * Using
 */

require REBOOT_CORE_PATH . 'functions/reboot_include_by_theme.php';
require REBOOT_CORE_PATH . 'functions/reboot_key.php';


/**
 * Theme based config
 */

$status = reboot_include_by_theme('config');

/**
 * Agency
 */

if (!defined('REBOOT_AGENCY')) {
    define('REBOOT_AGENCY', 'Reboot');
}

if (!defined('REBOOT_AGENCY_URL')) {
    define('REBOOT_AGENCY_URL', 'https://reboot.com.tr');
}

if (!defined('REBOOT_AGENCY_SLUG')) {
    define('REBOOT_AGENCY_SLUG', reboot_key(REBOOT_AGENCY));
}

if (!defined('REBOOT_AGENCY_MENU_ICON')) {
    define('REBOOT_AGENCY_MENU_ICON', sprintf('dashicons-reboot-%s', REBOOT_AGENCY_SLUG));
}

if (!defined('REBOOT_AGENCY_EMAIL')) {
    define('REBOOT_AGENCY_EMAIL', 'info@reboot.com.tr');
}


/**
 * Client
 */

if (!defined('REBOOT_CLIENT')) {
    define('REBOOT_CLIENT', REBOOT_AGENCY);
}

if (!defined('REBOOT_CLIENT_URL')) {
    define('REBOOT_CLIENT_URL', REBOOT_AGENCY_URL);
}

if (!defined('REBOOT_CLIENT_SLUG')) {
    define('REBOOT_CLIENT_SLUG', sanitize_title(REBOOT_CLIENT));
}

if (!defined('REBOOT_CLIENT_ICON')) {
    define('REBOOT_CLIENT_ICON', REBOOT_CLIENT_SLUG);
}


/**
 * Child Theme
 */

if (!defined('REBOOT_CHILD_TEXT_DOMAIN')) {
    define('REBOOT_CHILD_TEXT_DOMAIN', 'the7mk2');
}