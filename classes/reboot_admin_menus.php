<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_admin_menus')) {

    class reboot_admin_menus
    {

        /**
         * Constructor
         */
        public function __construct()
        {
            add_action('admin_menu', [$this, 'add_menu_page'], 1);
        }

        function add_menu_page()
        {
            add_menu_page(
                REBOOT_AGENCY,
                REBOOT_AGENCY,
                'manage_options',
                REBOOT_AGENCY_SLUG,
                [$this, 'render'],
                sprintf('dashicons-reboot-%s', REBOOT_AGENCY_SLUG),
                2
            );
        }

        function render()
        {
            ?>
            <div id="reboot-dashboard" class="<?= REBOOT_AGENCY_SLUG ?> wrap">

                <div class="reboot-welcome">
                    <h1><?= sprintf(__('Welcome to %s!', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY) ?></h1>
                    <p class="reboot-subtitle"><?= __('This menu is about collecting some important links together. <br>You could start installing recommended plugins.', REBOOT_TEXT_DOMAIN) ?></p>
                </div>

                <?php if(false) : ?>
                <div class="reboot-postbox">
                    <h2 class="reboot-with-subtitle"><?= __('Let’s get some work done!', REBOOT_TEXT_DOMAIN) ?></h2>
                    <p class="reboot-subtitle"><?= __('We have assembled useful links to get you started:', REBOOT_TEXT_DOMAIN) ?></p>

                    <div class="reboot-column-container">

                        <div class="reboot-column" style="width: 40%;">
                            <h3><?= __('The 7', REBOOT_TEXT_DOMAIN) ?></h3>
                            <ul class="reboot-links">
                                <li>
                                    <a target="_blank" href="<?= admin_url('admin.php?page=the7-plugins') ?>"
                                       class="dashicons-before dashicons-admin-plugins"><?= sprintf(__('Install recommended %s plugins', REBOOT_TEXT_DOMAIN), 'The 7') ?></a>

                                    <div class="reboot-notes">
                                        <ol>
                                            <li>The7 WPBakery Page Builder</li>
                                            <li>The7 Slider Revolution</li>
                                            <li>Contact Form 7</li>
                                        </ol>

                                        <p>Other plugins not necessary most time.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="reboot-column" style="width: 40%;">
                            <h3><?= REBOOT_AGENCY ?></h3>
                            <ul class="reboot-links">
                                <li>
                                    <a target="_blank" href="<?= admin_url(sprintf('admin.php?page=%s-install-plugins', REBOOT_AGENCY_SLUG)) ?>"
                                       class="dashicons-before dashicons-admin-plugins"><?= sprintf(__('Install recommended %s plugins', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY) ?></a>

                                    <div class="reboot-notes">
                                        <ol>
                                            <li>ACF Pro</li>
                                            <li>ACF Repeater</li>
                                            <li>Contact Form 7</li>
                                            <li>Clean Image Filenames</li>
                                            <li>Yoast SEO</li>
                                        </ol>
                                        <p>Other plugins not necessary most time.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
                <?php endif; ?>

            </div>

            <style>
                #reboot-dashboard {
                    margin: 0 32px 0 12px;
                    padding: 0;
                    max-width: 1060px;
                    font-size: 14px;
                    line-height: 1.5em;
                    color: #444;
                }

                #reboot-dashboard .reboot-welcome {
                    position: relative;
                    box-sizing: border-box;
                    min-height: 120px;
                    padding: 0 130px 0 0;
                    margin: 16px 0;
                    overflow: hidden;
                }

                #reboot-dashboard .reboot-welcome h1 {
                    margin-top: 16px;
                }

                #reboot-dashboard h1 {
                    margin: 32px 0 16px;
                    padding: 0;
                    color: #32373c;
                    line-height: 1em;
                    font-size: 32px;
                    font-weight: 400;
                }

                #reboot-dashboard h2 {
                    margin: 16px 0;
                    padding: 0;
                    color: #23282d;
                    font-size: 21px;
                    line-height: 1em;
                    font-weight: 400;
                }

                #reboot-dashboard .reboot-column h3 {
                    margin: 16px 0;
                    padding: 0;
                    color: #23282d;
                    font-size: 16px;
                    line-height: 1.5em;
                    font-weight: 600;
                }

                #reboot-dashboard .reboot-with-subtitle {
                    margin-bottom: 0;
                }

                #reboot-dashboard .reboot-subtitle {
                    margin: 0 0 16px;
                    color: #555d66;
                    font-size: 16px;
                    line-height: 1.5em;
                }

                #reboot-dashboard .reboot-postbox {
                    padding: 8px 24px;
                    margin: 16px 0;
                    border: 1px solid #e5e5e5;
                    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
                    box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
                    background: #fff;
                }

                #reboot-dashboard .reboot-column-container {
                    overflow: hidden;
                    margin: 0 -12px;
                }

                #reboot-dashboard .reboot-column {
                    float: left;
                    box-sizing: border-box;
                    width: 50%;
                    padding: 0 12px;
                }

                #reboot-dashboard .reboot-links a {
                    text-decoration: none;
                }

                #reboot-dashboard .reboot-links ol {
                    padding: 0 1em !important;
                    margin: 1em 0;
                }

                #reboot-dashboard .reboot-links ol:first-child {
                    margin-top: 0;
                }

                #reboot-dashboard .reboot-notes {
                    border-left: 1px dashed #e1e1e1;
                    padding-left: 1em;
                    margin-left: 0.8em;
                    margin-top: 1em;
                }

                #reboot-dashboard [class*="dashicons-"]:before {
                    display: inline-block;
                    color: #82878c;
                    vertical-align: top;
                    width: 28px;
                }
            </style>
            <?php
        }
    }

    new reboot_admin_menus();
}
