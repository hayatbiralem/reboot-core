<?php

$defaults = [
    'height' => 10
];

if(!isset($atts)) {
    $atts = [];
}

$atts = shortcode_atts($defaults, $atts);

?>
            <!-- Empty Space : BEGIN -->
            <tr>
                <td aria-hidden="true" height="<?= $atts['height'] ?>" style="font-size: 0px; line-height: 0px;">
                    &nbsp;
                </td>
            </tr>
            <!-- Empty Space : END -->