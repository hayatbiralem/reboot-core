<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('reboot_custom_post_types_and_taxonomies')) {

    class reboot_custom_post_types_and_taxonomies
    {

        /**
         * Custom post types
         */
        var $custom_post_types;

        /**
         * Custom taxonomies
         */
        var $custom_taxonomies;

        function __construct()
        {
//            add_action('after_setup_theme', [$this, 'register_custom_post_types']);
//            add_action('after_setup_theme', [$this, 'register_custom_taxonomies']);

//            add_action('init', [$this, 'register_custom_taxonomies'], 9);
//            add_action('init', [$this, 'register_custom_post_types'], 10);

            add_action('after_setup_theme', [$this, 'register_custom_taxonomies'], 9);
            add_action('after_setup_theme', [$this, 'register_custom_post_types'], 10);

            add_action('add_meta_boxes', [$this, 'remove_meta_boxes'], 999);
            add_action('admin_head', [$this, 'remove_meta_boxes'], 999);

            add_action('restrict_manage_posts', [$this, 'filter_post_type_by_taxonomy'], 10, 1);
        }

        /**
         * Register custom post types
         *
         * @return void
         */
        function register_custom_post_types()
        {
            $custom_post_types = $this->get_custom_post_types();
            if (!empty($custom_post_types)) {
                foreach ($custom_post_types as $custom_post_type) {
                    if(!post_type_exists($custom_post_type['name'])) {
                        register_post_type($custom_post_type['name'], $custom_post_type['args']);
                    }
                }
            }
        }

        /**
         * Register custom taxonomies
         *
         * @return void
         */
        function register_custom_taxonomies()
        {
            $custom_taxonomies = $this->get_custom_taxonomies();
            if (!empty($custom_taxonomies)) {
                foreach ($custom_taxonomies as $custom_taxonomy) {
                    register_taxonomy($custom_taxonomy['name'], $custom_taxonomy['post_types'], $custom_taxonomy['args']);
                }
            }
        }

        /**
         * Remove meta boxes
         *
         * @return void
         */
        function remove_meta_boxes()
        {
            $custom_post_types = $this->get_custom_post_types();
            if (!empty($custom_post_types)) {
                foreach ($custom_post_types as $custom_post_type) {
                    if (isset($custom_post_type['remove_meta_boxes']) && is_array($custom_post_type['remove_meta_boxes']) && !empty($custom_post_type['remove_meta_boxes'])) {
                        foreach ($custom_post_type['remove_meta_boxes'] as $remove_meta_box => $side) {
                            remove_meta_box($remove_meta_box, $custom_post_type['name'], $side);
                        }
                    }
                }
            }
        }

        function get_custom_post_types()
        {
            $default_args = [
                'menu_position' => 3,
                'public' => true,
                'menu_icon' => REBOOT_AGENCY_MENU_ICON, // 'dashicons-layout',
                'supports' => ['title'],

                'publicly_queryable' => false, // only admin
                'exclude_from_search' => true, // only admin
                'rewrite' => false, // only admin
                'query_var' => false, // only admin
            ];

            $front_end_args = [
                'publicly_queryable' => true,
                'exclude_from_search' => false,
                'query_var' => true,
            ];

            $this->custom_post_types = array();

            if(!defined('REBOOT_CORE_DISABLE_BLOCKS') || !REBOOT_CORE_DISABLE_BLOCKS) {
                $this->custom_post_types['block'] = [
                    'name' => 'block',
                    'remove_meta_boxes' => [
                        'wpseo_meta' => 'normal',
                        'mymetabox_revslider_0' => 'normal',
                    ],
                    'args' => [
                        'supports' => ['title', 'editor', 'thumbnail'],
                        'labels' => reboot_custom_post_types_and_taxonomies::get_post_type_labels(
                            __('Block', REBOOT_CORE_TEXT_DOMAIN),
                            __('Blocks', REBOOT_CORE_TEXT_DOMAIN)
                        ),
                    ]
                ];
            }

            $this->custom_post_types = apply_filters('reboot_custom_post_types', $this->custom_post_types);

            foreach ($this->custom_post_types as &$custom_post_type) {
                $custom_post_type['args'] = array_merge($default_args, $custom_post_type['args']);

                if ($custom_post_type['args']['rewrite']) {
                    $custom_post_type['args'] = array_merge($custom_post_type['args'], $front_end_args);
                }
            }
            unset($custom_post_type);

            return $this->custom_post_types;
        }

        function get_custom_taxonomies()
        {
            $default_args = [
                "public" => false, // false for only admin area
                "rewrite" => false, // false for only admin area
                // "rewrite" => array( 'slug' => 'page_category', 'with_front' => true, ),

                "hierarchical" => true,
                "show_ui" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "query_var" => true,

                "show_admin_column" => true,
                "show_in_quick_edit" => true,

                "show_in_rest" => false,
                "rest_base" => "",
            ];

            $front_end_args = [
                'public' => true,
            ];

            $this->custom_taxonomies = array(

//                'page_category' => [
//                    'name' => 'page_category',
//                    'post_types' => ['page'],
//                    'args' => [
//                        "labels" => reboot_custom_post_types_and_taxonomies::get_taxonomy_labels(
//                            __('Page Category', REBOOT_CHILD_TEXT_DOMAIN),
//                            __('Page Categories', REBOOT_CHILD_TEXT_DOMAIN)
//                        ),
//                    ],
//                ],

            );

            $this->custom_taxonomies = apply_filters('reboot_custom_taxonomies', $this->custom_taxonomies);

            foreach ($this->custom_taxonomies as &$custom_taxonomy) {
                $custom_taxonomy['args'] = array_merge($default_args, $custom_taxonomy['args']);

                if ($custom_taxonomy['args']['rewrite']) {
                    $custom_taxonomy['args'] = array_merge($custom_taxonomy['args'], $front_end_args);
                }
            }
            unset($custom_taxonomy);

            return $this->custom_taxonomies;
        }

        public static function get_post_type_labels($singular, $plural)
        {
            return [
                'name' => $plural,
                'singular_name' => $singular,
                // 'add_new' => __('Add New', REBOOT_CORE_TEXT_DOMAIN),
                'add_new_item' => sprintf(__('Add New %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'edit_item' => sprintf(__('Edit %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'new_item' => sprintf(__('Add New %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'view_item' => sprintf(__('View %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'view_items' => sprintf(__('View %s', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'search_items' => sprintf(__('Search %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'not_found' => sprintf(__('No %s found', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'not_found_in_trash' => sprintf(__('No %s found in Trash', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'parent_item_colon' => sprintf(__('Parent %s:', REBOOT_CORE_TEXT_DOMAIN), $singular),

                // 'all_items' => sprintf(__('All %s', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'all_items' => $plural,

                'archives' => sprintf(__('%s Archives', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'attributes' => sprintf(__('%s Attributes', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'insert_into_item' => sprintf(__('Insert into %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'uploaded_to_this_item' => sprintf(__('Uploaded to this %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                // 'featured_image' => __('Featured Image', REBOOT_CORE_TEXT_DOMAIN),
                // 'set_featured_image' => __('Set featured image', REBOOT_CORE_TEXT_DOMAIN),
                // 'remove_featured_image' => __('Remove featured image', REBOOT_CORE_TEXT_DOMAIN),
                // 'use_featured_image' => __('Use as featured image', REBOOT_CORE_TEXT_DOMAIN),
                // 'menu_name' => $plural,
                'filter_items_list' => sprintf(__('Filter %s list', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'items_list_navigation' => sprintf(__('%s list navigation', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'items_list' => sprintf(__('%s list', REBOOT_CORE_TEXT_DOMAIN), $singular),
                // 'name_admin_bar' => $singular,
                'item_published' => sprintf(__('%s published.', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'item_published_privately' => sprintf(__('%s published privately.', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'item_reverted_to_draft' => sprintf(__('%s reverted to draft.', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'item_scheduled' => sprintf(__('%s scheduled.', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'item_updated' => sprintf(__('%s updated.', REBOOT_CORE_TEXT_DOMAIN), $singular),
            ];
        }

        public static function get_taxonomy_labels($singular, $plural)
        {
            return [
                'name' => $plural,
                'singular_name' => $singular,
                // 'menu_name' => $plural,
                'all_items' => sprintf(__('All %s', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'edit_item' => sprintf(__('Edit %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'view_item' => sprintf(__('View %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'update_item' => sprintf(__('Update %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'add_new_item' => sprintf(__('Add New %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'new_item_name' => sprintf(__('New %s Name', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'parent_item' => sprintf(__('Parent %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'parent_item_colon' => sprintf(__('Parent %s:', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'search_items' => sprintf(__('Search %s', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'popular_items' => sprintf(__('Popular %s', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'separate_items_with_commas' => sprintf(__('Separate %s with commas', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'add_or_remove_items' => sprintf(__('Add or remove %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'choose_from_most_used' => sprintf(__('Choose from the most used %s', REBOOT_CORE_TEXT_DOMAIN), $singular),
                'not_found' => sprintf(__('No %s found.', REBOOT_CORE_TEXT_DOMAIN), $plural),
                'back_to_items' => sprintf(__('← Back to %s', REBOOT_CORE_TEXT_DOMAIN), $plural),
            ];
        }

        /**
         * Display a custom taxonomy dropdown in admin
         * @author Mike Hemberger
         * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
         */

        function filter_post_type_by_taxonomy($_post_type)
        {
            $taxonomies = $this->get_custom_taxonomies();

            if (!empty($taxonomies)) {
                foreach ($taxonomies as $taxonomy_obj) {
                    if (!empty($taxonomy_obj['post_types'])) {
                        foreach ($taxonomy_obj['post_types'] as $post_type) {

                            if ($_post_type !== $post_type) {
                                continue;
                            }

                            $slug = $taxonomy_obj['name'];
                            $taxonomy = get_taxonomy($taxonomy_obj['name']);
                            $selected = isset($_REQUEST[$slug]) ? $_REQUEST[$slug] : '';
                            wp_dropdown_categories(array(
                                'show_option_all' => $taxonomy->labels->all_items,
                                'taxonomy' => $slug,
                                'name' => $slug,
                                'orderby' => 'name',
                                'value_field' => 'slug',
                                'selected' => $selected,
                                'hierarchical' => true,
                            ));
                        }
                    }
                }
            }
        }

    }

    new reboot_custom_post_types_and_taxonomies();

}
