<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if(!is_singular()) {
    return;
}

if(!isset($platforms)) {
    $platforms = null;
}

$sharer_links = reboot_sharer_links([
    'type' => 'text',
    'title' => get_the_title(),
    'url' => get_permalink()
], $platforms);

if(!empty($sharer_links)) {
    echo $sharer_links;
}