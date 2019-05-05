<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if(!class_exists('reboot_dashboard_widgets')) {

    class reboot_dashboard_widgets
    {

        function __construct()
        {
            add_action('wp_dashboard_setup', array($this, 'add_dashboard_widgets'));
        }

        public function add_dashboard_widgets()
        {
            $widgets = array(
                'useful_links' => __('Useful Links', REBOOT_CORE_TEXT_DOMAIN),
            );

            foreach ($widgets as $widget => $title) {
                wp_add_dashboard_widget(
                    'reboot_dashboard_widget_' . $widget,
                    $title,
                    array($this, $widget)
                );
            }
        }

        public function useful_links()
        {
            $services = [
                [
                    'title' => 'Bulk Resize Photos',
                    'description' => __('Uses browser image resizing without uploading so blazing fast resizing with very large files', REBOOT_CORE_TEXT_DOMAIN),
                    'link_text' => 'bulkresizephotos.com',
                    'link_href' => 'https://bulkresizephotos.com'
                ],
                [
                    'title' => 'Pixlr X',
                    'description' => __('HTML5/Javascript based simple but very handy online image editing software', REBOOT_CORE_TEXT_DOMAIN),
                    'link_text' => 'pixlr.com/x',
                    'link_href' => 'https://pixlr.com/x'
                ],
                [
                    'title' => 'Pixlr Editor',
                    'description' => __('Flash based Photoshop like online image editing software', REBOOT_CORE_TEXT_DOMAIN),
                    'link_text' => 'pixlr.com/editor',
                    'link_href' => 'https://pixlr.com/editor'
                ],
            ];

            ?>
            <div class="reboot-dashboard-links-table">
                <table class="widefat striped fixed_">
                    <thead>
                    <tr>
                        <th><?= __('Service', REBOOT_CORE_TEXT_DOMAIN) ?></th>
                        <th><?= __('Link', REBOOT_CORE_TEXT_DOMAIN) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($services as $service) : ?>
                        <tr>
                            <td>
                                <div>
                                    <strong><?= $service['title'] ?></strong>
                                </div>
                                <div>
                                    <small><?= $service['description'] ?></small>
                                </div>
                            </td>
                            <td>
                                <a class="button" href="<?= $service['link_href'] ?>" target="_blank"><?= $service['link_text'] ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <style>
                .reboot-dashboard-links-table {
                    margin: -13px -14px -13px -13px;
                }
                .reboot-dashboard-links-table small {
                    display: block;
                    line-height: 1.3 !important;
                }
            </style>
            <?php
        }

    }

    new reboot_dashboard_widgets();

}
