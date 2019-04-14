<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

if(!class_exists('reboot_post_options')) {

    class reboot_post_options {

        /**
         * clickcarrot_custom_sidebars constructor.
         */
        function __construct()
        {
            add_action('acf/init', [$this, 'acf_init'], 20);
        }

        function acf_init(){
            $this->add_local_field_group();
        }

        function add_local_field_group(){

        }
    }

    new reboot_post_options();

}

