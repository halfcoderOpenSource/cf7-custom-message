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

    // Direct database query is intentional for uninstall cleanup
    // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM {$wpdb->postmeta} WHERE meta_key = %s",
            '_cf7_custom_validation_messages'
        )
    );
    // phpcs:enable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching

    // Clear any cached data
    wp_cache_flush();
}

// Run the uninstall
cf7_custom_messages_uninstall();

