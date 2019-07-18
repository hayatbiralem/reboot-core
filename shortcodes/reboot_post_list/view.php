<?php

$args = [
    'post_type' => $post_type,
    'posts_per_page' => $count,
    'post_status' => 'publish',
    'suppress_filters' => false,
];

if (is_singular($post_type)) {
    $args['post__not_in'] = [get_the_ID()];
}

if (!empty($taxonomy) && !empty($terms)) {
    $args['tax_query'] = [
        [
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => explode('|', $terms),
        ]
    ];
}

$items = get_posts($args);

if (empty($items)) {
    $post_type_object = get_post_type_object($post_type);
    if (isset($post_type_object->labels)) {
        $singular_name = $post_type_object->labels->singular_name;
    } else {
        $singular_name = $post_type;
    }
    return sprintf(__('No %s items found.', REBOOT_CORE_TEXT_DOMAIN), $singular_name);
}

?>
    <ul class="c-post-list c-post-list--<?= $post_type ?>">
        <?php foreach ($items as $item) : ?>
            <li class="c-post-list__item">
                <a href="<?= get_the_permalink($item) ?>" class="c-post-list__link">
                    <?php
                        if(has_post_thumbnail($item)) {
                            echo get_the_post_thumbnail($item, 'thumbnail', ['class' => 'c-post-list__image']);
                        }
                    ?>
                    <span class="c-post-list__title"><?= apply_filters('reboot_post_list_title', $item->post_title) ?></span>
                    <span class="c-post-list__date"><?= date_i18n(get_option('date_format'), strtotime($item->post_date)) ?></span>
                    <?php
                    /*

                    <?php if (has_excerpt($item)) : ?>
                    <?php if (has_excerpt($item)) : ?>
                        <span class="c-post-list__description"><?= apply_filters('reboot_post_list_description', get_the_excerpt($item)) ?></span>
                    <?php endif; ?>

                     */
                    ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php

