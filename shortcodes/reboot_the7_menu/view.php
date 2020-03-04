<?php

$extended_menu = new The7_Extended_Microwidgets_Menu();
$extended_menu->add_hooks();

$args = [];
if(isset($menu_wrap_class) && !empty($menu_wrap_class)) {
    $args['menu_wrap_class'] = $menu_wrap_class;
}
reboot_presscore_nav_menu_list(null, $nav_menu, $args);

$extended_menu->remove_hooks();
