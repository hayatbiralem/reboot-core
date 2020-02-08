<?php

if (!function_exists('presscore_get_topbar_social_icons')) {
    return;
}

// Bail early if there is no mobile image
if (!isset($image) || empty($image)) {
    return;
}

$el_class .= ' c-image--' . $counter;

$css = [];

if (!isset($image_size) || empty($image_size)) {
    $image_size = 'full';
}

$img = wpb_getImageBySize(array(
    'attach_id' => $image,
    'thumb_size' => $image_size,
    'class' => 'c-image__img js-fit' . ( !empty($image_class) ? ' ' . $image_class : '' ),
));

if (empty($image_ratio)) {
    $re_image_sizes = '/ width="([^"]+)" height="([^"]+)"/m';
    preg_match_all($re_image_sizes, $img['thumbnail'], $matches, PREG_SET_ORDER, 0);
    $image_ratio = sprintf('%s:%s', $matches[0][1], $matches[0][2]);
}

if (!empty($image_ratio)) {
    $percentage = reboot_get_percentage_from_ratio_string($image_ratio);
    if ($percentage > 0) {
        $css[] = str_replace(
            ['{counter}', '{padding-bottom}'],
            [$counter, $percentage],
            '.c-image--{counter} .c-image__picture:before { padding-bottom: {padding-bottom}%; }'
        );
    }
}


// remove dimensions for possible orientation change
$img['thumbnail'] = preg_replace('/ (width|height)="([^"]+)"/m', '', $img['thumbnail']);


$source = '';
if (isset($desktop_image) && !empty($desktop_image)) {

    if (!isset($desktop_image_size) || empty($desktop_image_size)) {
        $desktop_image_size = 'full';
    }

    $desktop_img = wpb_getImageBySize(array(
        'attach_id' => $desktop_image,
        'thumb_size' => $desktop_image_size,
    ));

    if (empty($desktop_image_ratio)) {
        $re_image_sizes = '/ width="([^"]+)" height="([^"]+)"/m';
        preg_match_all($re_image_sizes, $img['thumbnail'], $matches, PREG_SET_ORDER, 0);
        $desktop_image_ratio = sprintf('%s:%s', $matches[0][1], $matches[0][2]);
    }

    if (!empty($desktop_image_ratio)) {
        $percentage = reboot_get_percentage_from_ratio_string($desktop_image_ratio);
        if ($percentage > 0) {
            $css[] = str_replace(
                ['{counter}', '{padding-bottom}'],
                [$counter, $percentage],
                '@media (min-width: 768px) { .c-image--{counter} .c-image__picture:before { padding-bottom: {padding-bottom}%; } }'
            );
        }
    }

    if (strpos($desktop_img['thumbnail'], 'srcset')) {
        $re = '/srcset="([^"]+)" sizes="([^"]+)"/m';
        preg_match_all($re, $desktop_img['thumbnail'], $matches, PREG_SET_ORDER, 0);
        $source = sprintf('<source srcset="%s" sizes="%s" media="(min-width: 768px)">', $matches[0][1], $matches[0][2]);
    } else {
        $re = '/src="([^"]+)"/m';
        preg_match_all($re, $desktop_img['thumbnail'], $matches, PREG_SET_ORDER, 0);
        $source = sprintf('<source srcset="%s" media="(min-width: 768px)">', $matches[0][1]);
    }
}

if(isset($link) && !empty($link)) {
    $link = reboot_vc_parse_link($link);
}

/**
 * Styles
 */

if (!empty($css)) {
    $inline_style = sprintf('<style>%s</style>', implode("\n", $css));
} else {
    $inline_style = '';
}

$el_class = trim($el_class);

ob_start();

?>

<?php if (!empty($source)) : ?>
    <picture class="c-image__picture">
        <?= '<!--[if IE 9]><video style="display: none;"><![endif]-->' ?>
        <?= $source ?>
        <?= '<!--[if IE 9]></video><![endif]-->' ?>
        <?= $img['thumbnail'] ?>
    </picture>
<?php else: ?>
    <span class="c-image__picture">
        <?= $img['thumbnail'] ?>
    </span>
<?php endif; ?>

<?php

$output = ob_get_clean();

$output = trim(
    str_replace(
        ' attachment-full',
        '',
        $output
    )
);

if(!empty($link)) {
    echo sprintf('<a class="c-image%s"%s %s>%s</a>', reboot_attr($el_class), reboot_attr('id', $el_id), $link['attributes'], $output);
} else {
    echo sprintf('<span class="c-image%s"%s>%s</span>', reboot_attr($el_class), reboot_attr('id', $el_id), $output);
}
?>

<?php if (!empty($inline_style)) : ?>
    <?= $inline_style ?>
<?php endif; ?>
