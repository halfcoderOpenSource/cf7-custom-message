<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package    CF7_Custom_Messages
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

/**
 * Delete all plugin data from the database
 */
function cf7_custom_messages_uninstall() {
    global $wpdb;

    // Delete all custom message meta from CF7 forms
    $wpdb->query(
        "DELETE FROM {$wpdb->postmeta} 
        WHERE meta_key = '_cf7_custom_validation_messages'"
    );

    // Clear any cached data
    wp_cache_flush();
}

// Run the uninstall
cf7_custom_messages_uninstall();

