<?php

$defaults = [
    'link' => home_url('/'),
    'image' => REBOOT_CORE_URL . 'classes/reboot_email_template/assets/logo.png',
    'width' => '240',
    'height' => '50',
    'alt' => "",
    'title' => get_bloginfo('name'),
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>

            <!-- Logo : BEGIN -->
            <tr>
                <td style="padding: 20px 0; text-align: center; background-color: #ffffff;">
                    <?= !empty($atts['link']) ? '<a href="'.$atts['link'].'" title="'.$atts['title'].'" style="text-decoration: none; display: inline-block;">' : '' ?>
                    <img src="<?= $atts['image'] ?>" width="<?= $atts['width'] ?>" height="<?= $atts['height'] ?>" alt="<?= $atts['alt'] ?>" border="0" style="height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                    <?= !empty($atts['link']) ? '</a>' : '' ?>
                </td>
            </tr>
            <!-- Logo : END -->