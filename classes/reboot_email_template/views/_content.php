<?php

$defaults = [
    'content' => '',
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>

            <!-- Content : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                <?= reboot_email_template::inline_css($atts['content']) ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Content : END -->