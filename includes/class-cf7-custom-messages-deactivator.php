<?php
/**
 * Fired during plugin deactivation.
 *
 * @package    CF7_Custom_Messages
 * @subpackage CF7_Custom_Messages/includes
 */

/**
 * Fired during plugin deactivation.
 */
class CF7_Custom_Messages_Deactivator {

    /**
     * Plugin deactivation tasks.
     */
    public static function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
}

