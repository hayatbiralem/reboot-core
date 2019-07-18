<?php

$defaults = [
    'text' => '',
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>
            <!-- Title : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-bottom: 1px solid #EBEBEF;">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                <h2 style="margin: 0; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #d82446; font-weight: bold; text-transform: uppercase;"><?= $atts['text'] ?></h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Title : END -->