<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (isset($condition) && !empty($condition) && !filter_var(reboot_replace_special_vars($condition), FILTER_VALIDATE_BOOLEAN)) {
    return;
}

// echo (get_post($id))->post_content;

if(isset($disable_wrapper)) {
    reboot_vc_template($id, $disable_wrapper);
} else {
    reboot_vc_template($id);
}
