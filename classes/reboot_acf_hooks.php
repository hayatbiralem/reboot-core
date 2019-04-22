<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if(!class_exists('reboot_acf_hooks')) {

    class reboot_acf_hooks{

        function __construct()
        {
            add_filter('acf/validate_value/type=email', [$this, 'validate_value_type_email'], 10, 4);
        }

        function validate_value_type_email($valid, $value, $field, $input){
            // bail early if value is already invalid
            if( !$valid ) {
                return $valid;
            }

            if($field['required'] && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $valid = sprintf( __('%s value is invalid', REBOOT_TEXT_DOMAIN), $field['label'] );
                // $valid = var_export($field, true);
            }

            return $valid;
        }

    }

    new reboot_acf_hooks();

}

