<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_sharer_links')) {

    function reboot_sharer_links($data, $platforms = null)
    {
        ob_start();

        $classes = [];

        if (!empty($data['type'])) {
            $classes[] = 'c-social-icons--' . $data['type'];
        }

        if (!empty($classes)) {
            $classes = ' ' . implode(' ', $classes);
        } else {
            $classes = '';
        }

        ?>

        <div class="c-sharer c-social-icons<?= $classes ?>">
            <ul class="c-social-icons__list">

                <?php if (!$platforms || strpos($platforms, 'facebook') !== false) : ?>
                    <li class="c-social-icons__item">
                        <a class="c-social-icons__link c-social-icons__link--facebook" target="_blank" rel="nofollow"
                           href="http://www.facebook.com/share.php?u=<?= esc_url($data['url']) ?>">
                        <span class="c-social-icons__icon">
                            <span class="fab fa-facebook"></span>
                        </span>
                            <span class="c-social-icons__text">
                            <?= sprintf(__('Share on %s', REBOOT_CORE_TEXT_DOMAIN), 'Facebook') ?>
                        </span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (!$platforms || strpos($platforms, 'twitter') !== false) : ?>
                    <li class="c-social-icons__item">
                        <a class="c-social-icons__link c-social-icons__link--twitter" target="_blank" rel="nofollow"
                           href="http://twitter.com/home/?status=<?= esc_url($data['title']) ?>+<?= esc_url($data['url']) ?>">
                        <span class="c-social-icons__icon">
                            <span class="fab fa-twitter"></span>
                        </span>
                            <span class="c-social-icons__text">
                            <?= sprintf(__('Share on %s', REBOOT_CORE_TEXT_DOMAIN), 'Twitter') ?>
                        </span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (!$platforms || strpos($platforms, 'linkedin') !== false) : ?>
                    <li class="c-social-icons__item">
                        <a class="c-social-icons__link c-social-icons__link--linkedin" target="_blank" rel="nofollow"
                           href="https://www.linkedin.com/shareArticle?mini=true&url=<?= esc_url($data['url']) ?>&title=<?= esc_url($data['title']) ?>&source=<?= urlencode(get_bloginfo('name')) ?>">
                        <span class="c-social-icons__icon">
                            <span class="fab fa-linkedin"></span>
                        </span>
                            <span class="c-social-icons__text">
                            <?= sprintf(__('Share on %s', REBOOT_CORE_TEXT_DOMAIN), 'Linkedin') ?>
                        </span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <?php

        return ob_get_clean();
    }

}