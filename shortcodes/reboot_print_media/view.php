<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

//$print_media = get_field('print_media');
//
//if(empty($print_media)) {
//    return;
//}
//
//foreach ($print_media as $media) {
//    echo $media['title'];
//    echo '<br>';
//}

global $sitepress;

if (!isset($action_content) || empty($action_content)) {
    $action_content = __('Show', REBOOT_CORE_TEXT_DOMAIN);
} else {
    $action_content = do_shortcode(urldecode(base64_decode($action_content)));
}


if (function_exists('wp_rml_get_attachments') && isset($folder)) {

    if($sitepress) {
        $current_lang = $sitepress->get_current_language();
        $default_lang = $sitepress->get_default_language();

        $sitepress->switch_lang( $default_lang );
    }

    $attachment_ids = wp_rml_get_attachments($folder, 'ASC', 'rml');

    if($sitepress) {
        $sitepress->switch_lang( $current_lang );
    }

//    var_export($attachment_ids);
//    return;

    if (!empty($attachment_ids)) {
        $attachments = get_posts([
            'post_type' => 'attachment',
            'post_status' => 'any',
            'post__in' => $attachment_ids,
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'post__in'
        ]);

        $table = '<table>';
        $body = '<tbody>';

        $columns = [__('Title', REBOOT_CORE_TEXT_DOMAIN) => 'post_title'];
        if (isset($add_description_column) && $add_description_column == 'true') {
            $columns[__('Description', REBOOT_CORE_TEXT_DOMAIN)] = 'post_content';
        }
        $columns[__('Action', REBOOT_CORE_TEXT_DOMAIN)] = 'attachment_url';

        $head = '<thead><tr>';
        foreach ($columns as $key => $column) {
            if ($column == 'attachment_url') {
                $head .= sprintf('<th style="text-align: right;">%s</th>', $key);
            } else {
                $head .= sprintf('<th>%s</th>', $key);
            }
        }
        $head .= '</tr></thead>';

        foreach ($attachments as $attachment) {

            $sub_column = [];
            $attachment_url = wp_get_attachment_url($attachment->ID);
            $attachment_type = wp_check_filetype($attachment_url);

            foreach ($columns as $key => $column) {
                switch ($column) {
                    case 'attachment_url':
                        if (!in_array($attachment_type['ext'], ['jpg', 'jpeg', 'png', 'gif'])) {
                            $template = '<a href="%s" class="default-btn-shortcode dt-btn dt-btn-s btn-inline-left" target="_blank"><span>%s</span></a>';
                        } else {
                            $meta = wp_get_attachment_metadata($attachment->ID);
                            $width = $meta['width'];
                            $height = $meta['height'];
                            $template = '<a href="%s" class="default-btn-shortcode dt-btn dt-btn-s btn-inline-left dt-pswp-item" data-large_image_width="' . $width . '" data-large_image_height="' . $height . '"><span>%s</span></a>';
                        }
                        $sub_column[$column] = sprintf($template, $attachment_url, $action_content);
                        break;
                    default:
                        if (isset($attachment->{$column})) {
                            $sub_column[$column] = $attachment->{$column};
                        } else {
                            $sub_column[$column] = '-';
                        }
                        break;
                }
            }

            $row = '<tr>';
            foreach ($sub_column as $column => $value) {
                if ($column == 'attachment_url') {
                    $row .= sprintf('<td style="text-align: right;">%s</td>', $value);
                } else {
                    $row .= sprintf('<td>%s</td>', $value);
                }
            }
            $row .= '</tr>';

            $body .= $row;
        }

        $body .= '</tbody>';

        $table .= $head;
        $table .= $body;
        $table .= '</table>';

        echo $table;

    } else {
        /** @var MatthiasWeb\RealMediaLibrary\folder\Folder $folder_object */
        $folder_object = wp_rml_get_object_by_id($folder);
        $folder_data = $folder_object->getRowData();
        // var_export($folder_data);
        printf('<p style="text-align: center;">%s</p>', sprintf(__('File not found in "%s" folder!', REBOOT_CORE_TEXT_DOMAIN), $folder_data->name));
    }
}
