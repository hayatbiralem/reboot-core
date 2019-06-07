<?php

$defaults = [
    'title' => '',
    'value' => '',
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>
            <!--  Row : Begin -->
            <tr>
                <td style="padding: 10px 20px; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #555555; font-weight: bold; text-transform: uppercase;">
                    <p style="margin: 0;"><?= $atts['title'] ?></p>
                </td>
                <td style="padding: 10px 20px; font-family: sans-serif; font-size: 16px; line-height: 20px; color: #555555;">
                    <p style="margin: 0;"><?= $atts['value'] ?></p>
                </td>
            </tr>
            <!--  Row : End -->
