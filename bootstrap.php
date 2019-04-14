<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}


/**
 * Include Helper
 */

require REBOOT_CORE_PATH . 'functions/reboot_include_folder.php';


/**
 * Include TGMPA
 */

require REBOOT_TGMPA_PATH . 'config.php';


/**
 * Include functions
 */
reboot_include_folder(REBOOT_CORE_PATH . 'functions');


/**
 * Include hooks and models
 */
reboot_include_folder(REBOOT_CORE_PATH . 'classes');
// reboot_include_sub_folders(REBOOT_CORE_PATH . 'classes');