<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_presscore_nav_menu_list')) {

    function reboot_presscore_nav_menu_list($location = null, $menu = null, $args = array())
    {
        $args = wp_parse_args(
            $args,
            array(
                'menu_wrap_class'  => '',
                'before_menu_name' => '',
                'after_menu_name'  => '',
                'submenu_class'    => 'sub-nav',
            )
        );

        $classes = presscore_split_classes( $args['menu_wrap_class'] );
        array_unshift( $classes, 'mini-nav' );

        echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
        presscore_nav_menu(
            array(
                'menu'                => $menu,
                'theme_location'      => $location,
                'items_wrap'          => '<ul id="' . esc_attr( "{$location}-menu" ) . '">%3$s</ul>',
                'submenu_class'       => $args['submenu_class'],
                'parent_is_clickable' => true,
                'fallback_cb'         => '',
            )
        );
        echo '<div class="menu-select"><span class="customSelect1"><span class="customSelectInner">' . $args['before_menu_name'] . esc_html( $menu->name ) . $args['after_menu_name'] . '</span></span></div>';
        echo '</div>';
    }

}