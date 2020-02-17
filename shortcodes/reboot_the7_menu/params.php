<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

$custom_menus = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    if ( is_array( $menus ) && ! empty( $menus ) ) {
        foreach ( $menus as $single_menu ) {
            if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
                $custom_menus[ $single_menu->name ] = $single_menu->term_id;
            }
        }
    }
}

return array(
    "name" => sprintf( __("%s Menu with Icons", REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "description" => __('Prints a menu with The7 icons', REBOOT_CORE_TEXT_DOMAIN),
    "icon" => "icon-reboot_the7_menu",
    "base" => "reboot_the7_menu",
    "class" => "",
    "category" => sprintf( __('%s Elements', REBOOT_CORE_TEXT_DOMAIN), REBOOT_AGENCY ),
    "params" => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Menu', REBOOT_CORE_TEXT_DOMAIN ),
            'param_name' => 'nav_menu',
            'value' => $custom_menus,
            'description' => empty( $custom_menus ) ? sprintf( esc_html__( 'Custom menus not found. Please visit %sAppearance > Menus%s page to create new menu.', REBOOT_CORE_TEXT_DOMAIN ), '<b>', '</b>' ) : esc_html__( 'Select menu to display.', REBOOT_CORE_TEXT_DOMAIN ),
            'admin_label' => false,
            'save_always' => true,
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Menu wrap class", REBOOT_CORE_TEXT_DOMAIN),
            "param_name" => "menu_wrap_class",
            "value" => "",
        ),
    ),
);
