<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!class_exists('reboot_disable_checked_ontop')) {

    class reboot_disable_checked_ontop
    {

        function __construct()
        {
            add_filter('wp_terms_checklist_args', array($this, 'disable_checked_ontop'), 10, 2);
        }

        /**
         * @param $args
         * @param $idPost
         * @return mixed
         */
        function disable_checked_ontop($args, $idPost)
        {
            $args['checked_ontop'] = false;
            return $args;
        }

    }

    new reboot_disable_checked_ontop();

}
