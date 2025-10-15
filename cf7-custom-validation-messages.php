<?php
/**
 * Plugin Name: CF7 Custom Validation Messages
 * Plugin URI: https://github.com/halfcoder/cf7-custom-validation-messages
 * Description: Extends Contact Form 7 by adding custom validation messages for each field. Allows you to replace default CF7 error messages with your own custom messages for better user experience.
 * Version: 2.4.0
 * Author: Mohammad Shadab Saifi
 * Author URI: https://halfaccessible.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cf7-custom-messages
 * Domain Path: /languages
 * Requires at least: 6.7
 * Requires PHP: 7.4
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Current plugin version.
 */
define( 'CF7_CUSTOM_MESSAGES_VERSION', '2.4.0' );
define( 'CF7_CUSTOM_MESSAGES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CF7_CUSTOM_MESSAGES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CF7_CUSTOM_MESSAGES_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_cf7_custom_messages() {
    require_once CF7_CUSTOM_MESSAGES_PLUGIN_DIR . 'includes/class-cf7-custom-messages-activator.php';
    CF7_Custom_Messages_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_cf7_custom_messages() {
    require_once CF7_CUSTOM_MESSAGES_PLUGIN_DIR . 'includes/class-cf7-custom-messages-deactivator.php';
    CF7_Custom_Messages_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cf7_custom_messages' );
register_deactivation_hook( __FILE__, 'deactivate_cf7_custom_messages' );

/**
 * The core plugin class.
 */
require CF7_CUSTOM_MESSAGES_PLUGIN_DIR . 'includes/class-cf7-custom-messages.php';

/**
 * Begins execution of the plugin.
 */
function run_cf7_custom_messages() {
    $plugin = new CF7_Custom_Messages();
    $plugin->run();
}

// Check if Contact Form 7 is active
if ( in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    run_cf7_custom_messages();
} else {
    // Show admin notice if CF7 is not active
    add_action( 'admin_notices', 'cf7_custom_messages_cf7_missing_notice' );
}

/**
 * Display admin notice if CF7 is not active.
 */
function cf7_custom_messages_cf7_missing_notice() {
    ?>
    <div class="notice notice-error">
        <p><?php esc_html_e( 'CF7 Custom Validation Messages requires Contact Form 7 to be installed and activated.', 'cf7-custom-messages' ); ?></p>
    </div>
    <?php
}

