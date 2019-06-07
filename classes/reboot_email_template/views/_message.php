<?php

$defaults = [
    'content' => '',
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>

            <!-- Message : BEGIN -->
            <tr>
                <td style="background-color: #d82446;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;" align="center">
                                <?php
                                echo reboot_email_template::inline_css($atts['content'], ['h1, p { color: #ffffff; }']);
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Message : END -->