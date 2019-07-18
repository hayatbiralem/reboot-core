<?php

$defaults = [
    'link' => home_url('/'),
    'image' => REBOOT_CORE_URL . 'classes/reboot_email_template/assets/banner.jpg',
    'width' => '660',
    'height' => '',
    'alt' => "",
    'title' => get_bloginfo('name'),
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>

            <!-- Banner : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <?= !empty($atts['link']) ? '<a href="'.$atts['link'].'" title="'.$atts['title'].'" style="text-decoration: none; display: block;">' : '' ?>
                    <img src="<?= $atts['image'] ?>" width="<?= $atts['width'] ?>" height="<?= $atts['height'] ?>" alt="<?= $atts['alt'] ?>" border="0" style="width: 100%; max-width: <?= $atts['width'] ?>px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img">
                    <?= !empty($atts['link']) ? '</a>' : '' ?>
                </td>
            </tr>
            <!-- Banner : END -->