<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (isset($condition) && !empty($condition) && !filter_var(reboot_replace_special_vars($condition), FILTER_VALIDATE_BOOLEAN)) {
    return;
}

// echo (get_post($id))->post_content;

reboot_vc_template($id);
