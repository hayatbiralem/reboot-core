<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_vc_the7_hide_notices')) {

    class reboot_vc_the7_hide_notices
    {

        /**
         * Constructor
         */
        public function __construct()
        {
            add_action( 'init', array($this, 'hide_registration_notice'), 10, 0 );
        }

        public function hide_registration_notice(){
            if(class_exists('Presscore_Modules_ThemeUpdateModule')) {
                remove_action( 'admin_notices', array( 'Presscore_Modules_ThemeUpdateModule', 'registration_admin_notice' ), 1 );
            }
        }

    }

    new reboot_vc_the7_hide_notices();

}