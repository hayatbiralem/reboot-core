<?php

$platforms = [
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'instagram' => 'Instagram',
    'youtube' => 'Youtube',
];

$defaults = [
    'follow_text' => __('Follow Us', REBOOT_CORE_TEXT_DOMAIN),
];

foreach ($platforms as $platform => $title) {
    $defaults[$platform] = '';
    // $defaults[$platform . '_image'] = home_url('/email/' . $platform.'.png');
    $defaults[$platform . '_image'] = REBOOT_CORE_URL . 'classes/reboot_email_template/assets/'.$platform.'.png';
}

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>

        <!-- Social : BEGIN -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <?php if(!empty($atts['follow_text'])) : ?>
            <tr>
                <td style="padding: 20px 20px 0 20px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #ffffff;">
                    <p style="margin: 0;"><?= $atts['follow_text'] ?></p>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td style="padding: 15px 20px 15px 20px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">

                    <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <?php foreach ($platforms as $platform => $title) : ?>
                            <?php if(!empty($atts[$platform]) && !empty($atts[$platform . '_image'])) : ?>
                            <td align="center" style="padding: 5px;">
                                <p style="margin: 0;">
                                    <a href="<?= $atts[$platform] ?>" class="social-link" title="<?= $title ?>"><img src="<?= $atts[$platform . '_image'] ?>" width="32" height="" alt="<?= $title ?>" border="0" style="width: 100%; max-width: 32px; height: auto; background: #332d51; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img"></a>
                                </p>
                            </td>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
        <!-- Social : END -->