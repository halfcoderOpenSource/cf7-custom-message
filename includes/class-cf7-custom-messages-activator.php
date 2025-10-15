<?php
/**
 * Fired during plugin activation.
 *
 * @package    CF7_Custom_Messages
 * @subpackage CF7_Custom_Messages/includes
 */

/**
 * Fired during plugin activation.
 */
class CF7_Custom_Messages_Activator {

    /**
     * Plugin activation tasks.
     */
    public static function activate() {
        // Check for Contact Form 7
        if ( ! is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) && ! is_plugin_active_for_network( 'contact-form-7/wp-contact-form-7.php' ) ) {
            deactivate_plugins( CF7_CUSTOM_MESSAGES_PLUGIN_BASENAME );
            wp_die(
                esc_html__( 'This plugin requires Contact Form 7 to be installed and activated.', 'cf7-custom-validation-messages' ),
                'Plugin dependency check',
                array( 'back_link' => true )
            );
        }

        // Flush rewrite rules
        flush_rewrite_rules();
    }
}

