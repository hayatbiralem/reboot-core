<?php

if (!function_exists('presscore_get_topbar_social_icons')) {
    return;
}

/**
 * Common
 */

$el_class .= ' c-box--' . $counter;

$el_class .= ' c-box--' . $color;

if (!empty($align)) {
    $el_class .= ' c-box--' . $align;
}

if (!empty($style)) {
    $el_class .= ' c-box--' . $style;
}

$css = [];

/**
 * Images
 */

if ($dynamic_content_enabled && $use_featured_image && !empty($entry_id) && has_post_thumbnail($entry_id)) {
    $image = get_post_thumbnail_id($entry_id);
}

if (!empty($image)) {
    $el_class .= ' c-box--image';
    $img = do_shortcode(sprintf('[reboot_image image="%s" image_size="%s" desktop_image="%s" desktop_image_size="%s" image_ratio="%s" desktop_image_ratio="%s"]', $image, $image_size, $desktop_image, $desktop_image_size, $image_ratio, $desktop_image_ratio));
} else {
    $img = '';
}


if ($style == 'hero') {

    if (!empty($height)) {
        $el_class .= ' c-box--height';

        if(empty($mobile_ratio)) {
            $min_width = '0';
        } else {
            $min_width = '768px';
        }

        $css[] = sprintf('@media (min-width: %s) { .c-box--%s.c-box--height .c-image__picture { height: %s; } }', $min_width, $counter, $height);
    }

}

/**
 * Overlay
 */

if (!empty($overlay_color)) {
    $el_class .= ' c-box--overlay';
    $css[] = sprintf('.c-box--%s.c-box--overlay .c-image__picture:after { background-color: %s; }', $counter, $overlay_color);
}

if (!empty($overlay_gradient)) {
    $el_class .= ' c-box--overlay-gradient';
    $css[] = sprintf('.c-box--%s.c-box--overlay-gradient .c-image__picture:after { %s }', $counter, $overlay_gradient);
}


/**
 * Icon
 */

if (!empty($icon)) {
    $el_class .= ' c-box--icon';
    $icon = '<span class="' . $icon . '"></span>';

    if(empty($icon_size)) {
        $icon_size = '3.25em';
    }

    if(!empty($icon_position)) {
        $el_class .= ' c-box--icon-position-' . $icon_position;
    }

    if(!empty($icon_style)) {
        $el_class .= ' c-box--icon-style-' . $icon_style;
    }

    $css[] = sprintf('@media (min-width: 768px) { .c-box--%1$s .c-box__icon { width: %2$s; height: %2$s; font-size: %2$s; line-height: %2$s; } }', $counter, $icon_size);
} else {
    $icon = '';
}


/**
 * Mobile Overlap
 */

if ($enable_mobile_overlap) {
    $el_class .= ' c-box--mobile-overlap';
}


/**
 * Content
 */

$content = [];

if (!empty($_content)) {
    $content[] = wpautop($_content);
}

$permalink = '';

if ($dynamic_content_enabled && !empty($entry_id)) {

    $entry = get_post($entry_id);

    $permalink = get_permalink($entry_id);

    if ($entry) {

        if (!empty($heading_tag)) {
            $title = get_the_title($entry);
            if (!empty($title)) {
                $content[] = sprintf('<%1$s>%2$s</%1$s>', $heading_tag, $title);
            }
        }

        if (!empty($content_source)) {
            if ($content_source == 'excerpt') {
                $description = get_the_excerpt($entry);
            } else {
                $description = get_the_content($entry);
            }

            if (!empty($description)) {
                $description = wpautop($description);
            }

            if (!empty($description)) {
                $content[] = $description;
            }
        }


    }

}


// Mobile

if (!empty($mobile_align)) {
    $el_class .= ' c-box--mobile-' . $mobile_align;
}

if (!empty($content_width)) {
    $el_class .= ' c-box--content-width';
    $css[] = sprintf('@media (min-width: 768px) { .c-box--%s .c-box__caption { width: %s; } }', $counter, $content_width);
};

if (!empty($mobile_content_width)) {
    $el_class .= ' c-box--mobile-content-width';
    $css[] = sprintf('@media (max-width: 767px) { .c-box--%s .c-box__caption { width: %s; } }', $counter, $mobile_content_width);
};

if ($mobile_hide_button_1 == 'yes') {
    $el_class .= ' c-box--mobile-hide-button-1';
}

if ($mobile_hide_button_2 == 'yes') {
    $el_class .= ' c-box--mobile-hide-button-2';
}


// Actions

$action_replace = [
    '<reboot_box_tag' => '<div',
    '</reboot_box_tag' => '</div',
];

if (!empty($action)) {
    $el_class .= ' c-box--' . $action;

    switch ($action) {

        case 'box':
            if (!empty($link)) {
                $vc_link = reboot_vc_parse_link($link, $permalink);
                $action_replace['<reboot_box_tag'] = '<a ' . $vc_link['attributes'];
                $action_replace['</reboot_box_tag'] = '</a';
            }
            break;

        case 'one_button':
        case 'two_buttons':

            $buttons = do_shortcode(sprintf('[reboot_buttons button_1="%s" button_2="%s" size="%s" align="%s" full_width="%s" mobile_full_width="%s"]', $button_1, $button_2, $button_size, $align, $button_full_width, $mobile_button_full_width));
            $buttons = trim($buttons);
            if (!empty($buttons)) {
                $content[] = sprintf('<div class="c-box__buttons">%s</div>', $buttons);
            }

            break;

    }

}

if (!empty($content)) {
    $content = implode("\n ", $content);
}


/**
 * Styles
 */

if (!empty($css)) {
    $inline_style = sprintf('<style>%s</style>', implode("\n", $css));
} else {
    $inline_style = '';
}

/**
 * El Class
 */

$el_class = trim($el_class);

ob_start();

?>

<reboot_box_tag class="c-box<?= reboot_attr($el_class) ?>"<?= reboot_attr('id', $el_id) ?>>

    <?php if (!empty($img)) : ?>
        <div class="c-box__image">
            <?= $img ?>
        </div>
    <?php elseif (!empty($icon)) : ?>
        <div class="c-box__icon">
            <?= $icon ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($content)) : ?>
        <div class="c-box__caption js-mh--c-box__caption">
            <div class="c-box__content">
                <?= reboot_remove_empty_tags_v2($content, ['p']) ?>
            </div>
        </div>
    <?php endif; ?>

</reboot_box_tag>

<?php

$output = ob_get_clean();

$output = str_replace(
    array_keys($action_replace),
    array_values($action_replace),
    $output
);

echo $output;

?>

<?php if (!empty($inline_style)) : ?>
    <?= $inline_style ?>
<?php endif; ?>
