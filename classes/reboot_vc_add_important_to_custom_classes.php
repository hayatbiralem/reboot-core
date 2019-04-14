<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!class_exists('reboot_vc_add_important_to_custom_classes')) {

    class reboot_vc_add_important_to_custom_classes
    {
        var $meta_key = '_wpb_shortcodes_custom_css';

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->add_hook();
        }

        function add_important($result, $object_id, $meta_key, $single){
            if($meta_key == $this->meta_key) {
                $this->remove_hook();
                $data = get_post_meta( $object_id, $meta_key, $single );
                $this->add_hook();
                reboot_dd($data);
                return '';
            }

            return $result;
        }

        function add_hook(){
            add_filter("get_post_metadata", [$this, 'add_important'], 999, 4);
        }

        function remove_hook(){
            remove_filter("get_post_metadata", [$this, 'add_important'], 999);
        }
    }

    // Those rules are already important :)
    // new reboot_vc_add_important_to_custom_classes();
}
