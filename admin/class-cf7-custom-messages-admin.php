<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    CF7_Custom_Messages
 * @subpackage CF7_Custom_Messages/admin
 */

/**
 * The admin-specific functionality of the plugin.
 */
class CF7_Custom_Messages_Admin {

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
     * Register the stylesheets for the admin area.
     */
    public function enqueue_styles() {
        if ( $this->is_cf7_edit_page() ) {
            wp_enqueue_style(
                $this->plugin_name,
                CF7_CUSTOM_MESSAGES_PLUGIN_URL . 'assets/css/cf7-custom-messages-admin.css',
                array(),
                $this->version,
                'all'
            );
        }
    }

    /**
     * Register the JavaScript for the admin area.
     */
    public function enqueue_scripts() {
        if ( $this->is_cf7_edit_page() ) {
            wp_enqueue_script(
                $this->plugin_name,
                CF7_CUSTOM_MESSAGES_PLUGIN_URL . 'assets/js/cf7-custom-messages-admin.js',
                array( 'jquery' ),
                $this->version,
                false
            );
        }
    }

    /**
     * Check if we're on CF7 edit page.
     */
    private function is_cf7_edit_page() {
        $screen = get_current_screen();
        return $screen && ( $screen->id === 'toplevel_page_wpcf7' || strpos( $screen->id, 'wpcf7' ) !== false );
    }

    /**
     * Add custom messages panel to CF7 admin.
     */
    public function add_custom_messages_panel( $panels ) {
        $panels['custom-messages-panel'] = array(
            'title'    => __( 'Custom Messages', 'cf7-custom-messages' ),
            'callback' => array( $this, 'render_custom_messages_panel' )
        );

        return $panels;
    }

    /**
     * Render the custom messages panel.
     */
    public function render_custom_messages_panel( $post ) {
        // Get the contact form
        $contact_form = WPCF7_ContactForm::get_instance( $post->id() );
        
        if ( ! $contact_form ) {
            return;
        }

        // Get all form fields
        $form_fields = $this->get_form_fields( $contact_form );

        // Get saved custom messages
        $custom_messages = get_post_meta( $post->id(), '_cf7_custom_validation_messages', true );
        if ( ! is_array( $custom_messages ) ) {
            $custom_messages = array();
        }

        ?>
        <div class="cf7-custom-messages-wrapper">
            <h2><?php esc_html_e( 'Custom Validation Messages', 'cf7-custom-messages' ); ?></h2>
            <p class="description">
                <?php esc_html_e( 'Define custom validation messages for each field in your form. These messages will be displayed instead of the default validation messages when a field fails validation.', 'cf7-custom-messages' ); ?>
            </p>

            <?php if ( empty( $form_fields ) ) : ?>
                <div class="notice notice-warning inline">
                    <p><?php esc_html_e( 'No form fields found. Please add fields to your form first.', 'cf7-custom-messages' ); ?></p>
                </div>
            <?php else : ?>
                <table class="form-table cf7-custom-messages-table">
                    <thead>
                        <tr>
                            <th scope="col"><?php esc_html_e( 'Field Name', 'cf7-custom-messages' ); ?></th>
                            <th scope="col"><?php esc_html_e( 'Field Type', 'cf7-custom-messages' ); ?></th>
                            <th scope="col"><?php esc_html_e( 'Custom Validation Message', 'cf7-custom-messages' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $form_fields as $field ) : ?>
                            <?php
                            $field_name = $field['name'];
                            $field_type = $field['type'];
                            $custom_message = isset( $custom_messages[ $field_name ] ) ? $custom_messages[ $field_name ] : '';
                            ?>
                            <tr>
                                <td>
                                    <strong><?php echo esc_html( $field_name ); ?></strong>
                                    <?php if ( $field['required'] ) : ?>
                                        <span class="required-indicator">*</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="field-type-badge"><?php echo esc_html( $field_type ); ?></span>
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        name="cf7_custom_messages[<?php echo esc_attr( $field_name ); ?>]"
                                        value="<?php echo esc_attr( $custom_message ); ?>"
                                        class="regular-text"
                                        placeholder="<?php esc_attr_e( 'Enter custom message (leave empty for default)', 'cf7-custom-messages' ); ?>"
                                    />
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="cf7-custom-messages-help">
                    <h3><?php esc_html_e( 'Tips:', 'cf7-custom-messages' ); ?></h3>
                    <ul>
                        <li><?php esc_html_e( 'Leave a message field empty to use the default Contact Form 7 validation message.', 'cf7-custom-messages' ); ?></li>
                        <li><?php esc_html_e( 'Custom messages will be displayed when the field validation fails (e.g., required field is empty, invalid email format).', 'cf7-custom-messages' ); ?></li>
                        <li><?php esc_html_e( 'Fields marked with * are required fields.', 'cf7-custom-messages' ); ?></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Get all form fields from the contact form.
     */
    private function get_form_fields( $contact_form ) {
        $fields = array();
        $form_tags = $contact_form->scan_form_tags();

        foreach ( $form_tags as $tag ) {
            // Skip submit buttons and other non-input fields
            if ( in_array( $tag->type, array( 'submit', 'reset', 'recaptcha', 'captcha' ), true ) ) {
                continue;
            }

            // Skip fields without names
            if ( empty( $tag->name ) ) {
                continue;
            }

            $fields[] = array(
                'name'     => $tag->name,
                'type'     => $tag->basetype,
                'required' => $tag->is_required()
            );
        }

        return $fields;
    }

    /**
     * Save custom messages when form is saved.
     */
    public function save_custom_messages( $contact_form ) {
        // Check if custom messages are posted
        if ( ! isset( $_POST['cf7_custom_messages'] ) ) {
            return;
        }

        // Get form ID - handle both method and property access
        $form_id = null;
        if ( method_exists( $contact_form, 'id' ) ) {
            $form_id = $contact_form->id();
        } elseif ( isset( $contact_form->id ) ) {
            $form_id = $contact_form->id;
        }

        if ( ! $form_id ) {
            return;
        }

        $custom_messages = array();
        $posted_messages = $_POST['cf7_custom_messages'];

        if ( is_array( $posted_messages ) ) {
            foreach ( $posted_messages as $field_name => $message ) {
                $field_name = sanitize_text_field( $field_name );
                $message = sanitize_text_field( $message );

                // Save all messages, including empty ones (to allow clearing)
                $custom_messages[ $field_name ] = $message;
            }
        }

        // Save to post meta
        update_post_meta( $form_id, '_cf7_custom_validation_messages', $custom_messages );
    }
}

