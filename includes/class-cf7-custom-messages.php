<?php
/**
 * The core plugin class.
 *
 * @package    CF7_Custom_Messages
 * @subpackage CF7_Custom_Messages/includes
 */

/**
 * The core plugin class.
 */
class CF7_Custom_Messages {

    /**
     * The loader that's responsible for maintaining and registering all hooks.
     *
     * @var CF7_Custom_Messages_Loader
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @var string
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @var string
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     */
    public function __construct() {
        $this->version = CF7_CUSTOM_MESSAGES_VERSION;
        $this->plugin_name = 'cf7-custom-messages';

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     */
    private function load_dependencies() {
        /**
         * The class responsible for orchestrating the actions and filters.
         */
        require_once CF7_CUSTOM_MESSAGES_PLUGIN_DIR . 'includes/class-cf7-custom-messages-loader.php';

        /**
         * The class responsible for defining all actions in the admin area.
         */
        require_once CF7_CUSTOM_MESSAGES_PLUGIN_DIR . 'admin/class-cf7-custom-messages-admin.php';

        /**
         * The class responsible for validation messages.
         */
        require_once CF7_CUSTOM_MESSAGES_PLUGIN_DIR . 'includes/class-cf7-custom-messages-validator.php';

        $this->loader = new CF7_Custom_Messages_Loader();
    }

    /**
     * Register all hooks related to the admin area.
     */
    private function define_admin_hooks() {
        $plugin_admin = new CF7_Custom_Messages_Admin( $this->get_plugin_name(), $this->get_version() );

        // Add custom tab to CF7 admin
        $this->loader->add_filter( 'wpcf7_editor_panels', $plugin_admin, 'add_custom_messages_panel' );
        
        // Save custom messages
        $this->loader->add_action( 'wpcf7_save_contact_form', $plugin_admin, 'save_custom_messages', 10, 1 );
        
        // Enqueue admin scripts and styles
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    }

    /**
     * Register all hooks related to the public-facing functionality.
     */
    private function define_public_hooks() {
        $plugin_validator = new CF7_Custom_Messages_Validator( $this->get_plugin_name(), $this->get_version() );

        // Override validation messages - priority 20 to run after CF7's default validation (priority 10)
        $this->loader->add_filter( 'wpcf7_validate_text', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_text*', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_email', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_email*', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_tel', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_tel*', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_textarea', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_textarea*', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_select', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_select*', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_checkbox', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_checkbox*', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_radio', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_acceptance', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_number', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_number*', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_date', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_date*', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_url', $plugin_validator, 'custom_validation_message', 20, 2 );
        $this->loader->add_filter( 'wpcf7_validate_url*', $plugin_validator, 'custom_validation_message', 20, 2 );
        
        // Override messages in AJAX response
        $this->loader->add_filter( 'wpcf7_ajax_json_echo', $plugin_validator, 'modify_ajax_response', 10, 2 );
    }

    /**
     * Run the loader to execute all hooks.
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin.
     *
     * @return string
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the loader.
     *
     * @return CF7_Custom_Messages_Loader
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return string
     */
    public function get_version() {
        return $this->version;
    }
}

