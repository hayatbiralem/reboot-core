<?php

$defaults = [
    'text' => __('Action', REBOOT_CORE_TEXT_DOMAIN),
    'link' => '#',
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>

            <!-- Action : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px;">
                                <!-- Button : BEGIN -->
                                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                                    <tr>
                                        <td class="button-td button-td-primary" style="border-radius: 4px; background: #222222;">
                                            <a class="button-a button-a-primary" href="<?= $atts['link'] ?>" style="background: #D82446; border: 1px solid #D82446; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 17px; color: #ffffff; display: block; border-radius: 4px;"><?= $atts['text'] ?></a>
                                        </td>
                                    </tr>
                                </table>
                                <!-- Button : END -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Action : END -->