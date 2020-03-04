<?php

if (!function_exists('presscore_get_topbar_social_icons')) {
    return;
}

$css = [];

$el_class .= ' c-space--' . $counter;

$el_class .= ' c-space--' . $size;

if ($size == 'custom') {

    if (!empty($mobile)) {
        $css[] = sprintf('.c-space--%s:before { padding-bottom: %s; }', $counter, $mobile);
    }

    if (!empty($desktop)) {
        $css[] = sprintf('@media (min-width: 768px) { .c-space--%s:before { padding-bottom: %s; } }', $counter, $desktop);
    }
}

?>
    <div class="c-space<?= reboot_attr($el_class) ?>"<?= reboot_attr('id', $el_id) ?>></div>
<?php

if (!empty($css)) {
    echo sprintf('<style>%s</style>', implode("\n", $css));
}