<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

//if(isset($description) && !empty($description)) {
//    $description = do_shortcode(urldecode(base64_decode($description)));
//}

$description = '';

if (isset($_content) && !empty($_content)) {
    $description = reboot_remove_empty_tags( reboot_fix_unclosed_html_tags(wpautop($_content)), 'p' );
}

if (!isset($title) || empty($title)) {
    $title = '';
}

$link_attributes = '';
$link = reboot_vc_parse_link($url);
if (!empty($link['href'])) {
    $link_attributes = ' ' . $link['attributes'];
}


$classes = ['c-reboot-smart-link'];

if (isset($link_classes) && !empty($link_classes)) {
    $classes[] = trim($link_classes);
}

if (isset($behavior) && !empty($behavior)) {
    $classes[] = trim(implode(' ', explode(',', $behavior)));
}

$classes = implode(' ', $classes);


ob_start();

?>
    <div class="c-reboot-smart-link__content">
        <?php if (!empty($title)) : ?>
            <h4 class="c-reboot-smart-link__title"><?= $title ?></h4>
        <?php endif; ?>

        <?php if (!empty($description)) : ?>
            <div class="c-reboot-smart-link__description"><?= $description ?></div>
        <?php endif; ?>
    </div>
<?php

$output = ob_get_clean();

if (!empty($link_attributes)) {
    printf('<a class="%s"%s>%s</a>', $classes, $link_attributes, $output);
} else {
    printf('<div class="%s">%s</div>', $classes, $output);
}