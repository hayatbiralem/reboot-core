<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if(isset($shortcode) && !empty($shortcode)) {
    echo do_shortcode(urldecode(base64_decode($shortcode)));
}