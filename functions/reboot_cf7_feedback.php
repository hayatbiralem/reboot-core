<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_cf7_feedback')) {

    function reboot_cf7_feedback( $request ) {
        $_temp_post = $_POST;

        $_POST = $request;

        $id = (int) $_POST['_wpcf7'];
        $item = wpcf7_contact_form( $id );

        if ( ! $item ) {
            return new WP_Error( 'wpcf7_not_found',
                __( "The requested contact form was not found.", 'contact-form-7' ),
                array( 'status' => 404 ) );
        }

        $result = $item->submit();

        $response = array(
            'status' => $result['status'],
            'message' => $result['message'],
        );

        if ( 'validation_failed' == $result['status'] ) {
            $invalid_fields = array();

            foreach ( (array) $result['invalid_fields'] as $name => $field ) {
                $invalid_fields[] = array(
                    'name' => $name,
                    'message' => $field['reason'],
                    'idref' => $field['idref'],
                );
            }

            $response['invalidFields'] = $invalid_fields;
        }

        $_POST = $_temp_post;

        return $response;
    }

}