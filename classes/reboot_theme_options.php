<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!class_exists('reboot_theme_options')) {

    class reboot_theme_options {

        /**
         * @var array
         */
        var $menu_slug;

        /**
         * clickcarrot_custom_sidebars constructor.
         */
        function __construct()
        {
            $this->menu_slug = sprintf('%s-theme-options', REBOOT_AGENCY_SLUG);

            add_action('acf/init', [$this, 'acf_init'], 20);
        }

        function acf_init(){
            $this->add_sub_page();
            // $this->add_local_field_group();
        }

        function add_sub_page(){
            acf_add_options_sub_page(array(
                'page_title' 	=> __('Theme Options', REBOOT_TEXT_DOMAIN),
                'menu_title'	=> __('Theme Options', REBOOT_TEXT_DOMAIN),
                'menu_slug'	=> $this->menu_slug,
                'parent_slug'	=> REBOOT_AGENCY_SLUG,
            ));
        }

        function add_local_field_group(){

        }
    }

    new reboot_theme_options();

}

