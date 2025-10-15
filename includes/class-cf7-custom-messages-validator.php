<?php
/**
 * The validation functionality of the plugin.
 *
 * @package    CF7_Custom_Messages
 * @subpackage CF7_Custom_Messages/includes
 */

/**
 * The validation functionality of the plugin.
 */
class CF7_Custom_Messages_Validator {

    /**
     * The ID of this plugin.
     *
     * @var string
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @var string
     */
    private $version;

    /**
     * Initialize the class.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Apply custom validation messages.
     */
    public function custom_validation_message( $result, $tag ) {
        // Get the field name
        $field_name = $tag->name;
        
        // Get the current form
        $submission = WPCF7_Submission::get_instance();
        if ( ! $submission ) {
            return $result;
        }

        $contact_form = $submission->get_contact_form();
        if ( ! $contact_form ) {
            return $result;
        }

        // Get form ID
        $form_id = method_exists( $contact_form, 'id' ) ? $contact_form->id() : $contact_form->id;
        if ( ! $form_id ) {
            return $result;
        }

        // Get custom messages
        $custom_messages = get_post_meta( $form_id, '_cf7_custom_validation_messages', true );
        if ( ! is_array( $custom_messages ) || ! isset( $custom_messages[ $field_name ] ) || empty( $custom_messages[ $field_name ] ) ) {
            return $result;
        }

        $custom_message = $custom_messages[ $field_name ];

        // Check if validation already failed - if so, replace the message
        if ( ! $result->is_valid() ) {
            // Remove existing invalid status
            $invalid_fields = $result->get_invalid_fields();
            
            // Re-invalidate with our custom message
            $result->invalidate( $tag, $custom_message );
        }

        return $result;
    }

    /**
     * Modify AJAX response to replace validation messages.
     */
    public function modify_ajax_response( $response, $result ) {
        $submission = WPCF7_Submission::get_instance();
        if ( ! $submission ) {
            return $response;
        }

        $contact_form = $submission->get_contact_form();
        if ( ! $contact_form ) {
            return $response;
        }

        // Get form ID
        $form_id = method_exists( $contact_form, 'id' ) ? $contact_form->id() : $contact_form->id;
        if ( ! $form_id ) {
            return $response;
        }

        // Get custom messages
        $custom_messages = get_post_meta( $form_id, '_cf7_custom_validation_messages', true );
        if ( ! is_array( $custom_messages ) || empty( $custom_messages ) ) {
            return $response;
        }

        // Check if there are invalid fields in the response
        if ( isset( $response['invalid_fields'] ) && is_array( $response['invalid_fields'] ) ) {
            foreach ( $response['invalid_fields'] as $key => $field ) {
                $field_name = isset( $field['field'] ) ? $field['field'] : '';
                
                // If we have a custom message for this field, replace it
                if ( $field_name && isset( $custom_messages[ $field_name ] ) && ! empty( $custom_messages[ $field_name ] ) ) {
                    $response['invalid_fields'][ $key ]['message'] = $custom_messages[ $field_name ];
                }
            }
        }

        return $response;
    }
}

