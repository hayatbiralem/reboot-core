<?php

$defaults = [
    'content' => '',
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>

    <!-- Full Bleed Background Section : BEGIN -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #d82446;">
        <tr>
            <td>
                <div align="center" style="max-width: 660px; margin: auto;" class="email-container">
                    <!--[if mso]>
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
                        <tr>
                            <td>
                    <![endif]-->
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; text-align: center; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #ffffff;">
                                <?= reboot_email_template::inline_css($atts['content'], ['p { color: #ffffff; }', 'a {text-decoration:underline; color:#ffffff;}']) ?>
                            </td>
                        </tr>
                    </table>
                    <!--[if mso]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </div>
            </td>
        </tr>
    </table>
    <!-- Full Bleed Background Section : END -->
