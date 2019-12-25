<?php

$video_formats = ['src', 'mp4', 'ogv', 'webm'];

$sources = [];

foreach ($video_formats as $video_format) {
    if (isset($$video_format) && !empty($$video_format)) {
        $sources[$video_format] = $$video_format;
    }
}

if (empty($sources)) {
    return;
}

if (isset($sources['src'])) {
    $video_file_info = pathinfo($sources['src']);
    if (!empty($video_file_info['extension'])) {
        $video_file_name = $video_file_info['filename'];
        $attachments = reboot_get_attachments_by_filename($video_file_name);
        // reboot_dd($attachments);
        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                $path_info = pathinfo($attachment->guid);
                // reboot_dd($path_info);
                if ($path_info['extension'] != $video_file_info['extension'] && !isset($sources[$path_info['extension']])) {
                    $sources[$path_info['extension']] = $attachment->guid;
                }
            }
        }
    }
}

// reboot_dd($sources);

$bool_features = ['muted', 'controls', 'loop', 'autoplay'];
$features_output = [];
$features = explode(',', $features);

foreach ($bool_features as $bool_feature) {
    $features_output[] = sprintf('%s="%s"', $bool_feature, (in_array($bool_feature, $features) ? 'on' : 'off'));
}

$features_output = implode(' ', $features_output);

$source_output = [];
foreach ($sources as $format => $source) {
    $source_output[] = sprintf('%s="%s"', $format, $source);
}
$source_output = implode(' ', $source_output);

$video_shortcode = sprintf('[video %s %s poster="%s" preload="%s" width="%s" height="%s"]', $source_output, $features_output, $poster, $preload, $width, $height);

//reboot_d($features);
//return;

$output = do_shortcode($video_shortcode);

$re = '/<video[^>]*>(.*?)<\/video>/is';
preg_match($re, $output, $matches, PREG_OFFSET_CAPTURE, 0);

?>

<div class="c-reboot-video">
    <?php
    echo str_replace(
        [' class="wp-video-shortcode"'],
        [''],
        $matches[0][0]
    );
    ?>
</div>
