# CF7 Custom Validation Messages

A WordPress plugin that extends Contact Form 7 by allowing you to define custom validation messages for each field in your forms.

## Description

CF7 Custom Validation Messages adds a new "Custom Messages" tab to the Contact Form 7 form editor, where you can easily customize validation error messages for each field. This gives you complete control over the error messages displayed to your users when form validation fails.

## Features

- **Custom Tab in CF7 Editor**: Adds a dedicated "Custom Messages" tab to the Contact Form 7 form editor
- **Field Detection**: Automatically detects and displays all fields from your form
- **Per-Field Customization**: Define custom validation messages for each individual field
- **Easy-to-Use Interface**: Clean, intuitive admin interface with field filtering and search
- **Real-time Feedback**: Visual indicators show which fields have custom messages
- **Compatible**: Works with all standard Contact Form 7 field types:
  - Text fields
  - Email fields
  - Phone/Tel fields
  - Textarea fields
  - Select dropdowns
  - Checkboxes
  - Radio buttons
  - Number fields
  - Date fields
  - URL fields
  - Acceptance fields

## Requirements

- WordPress 5.0 or higher
- PHP 7.2 or higher
- Contact Form 7 plugin (active)

## Installation

1. Upload the `cf7-custom-validation-messages` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Ensure Contact Form 7 is installed and activated
4. Navigate to any Contact Form 7 form editor
5. Click on the "Custom Messages" tab
6. Define your custom validation messages

## Usage

### Setting Custom Messages

1. Go to **Contact > Contact Forms** in your WordPress admin
2. Edit any existing form or create a new one
3. Click on the **"Custom Messages"** tab
4. You'll see a table listing all fields in your form
5. Enter custom validation messages for the fields you want to customize
6. Leave fields empty to use default CF7 validation messages
7. Click **Save** to store your custom messages

### Field Information

The Custom Messages tab displays:
- **Field Name**: The name attribute of each field
- **Field Type**: The type of field (text, email, tel, etc.)
- **Required Indicator**: An asterisk (*) shows required fields
- **Custom Message Input**: Text field to enter your custom validation message

### Tips

- Custom messages only appear when validation fails (e.g., required field is empty, invalid email format)
- Leave a message blank to use Contact Form 7's default validation message
- Use the search/filter feature to quickly find specific fields in large forms
- The counter shows how many fields have custom messages defined

## Development

### Plugin Structure

```
cf7-custom-validation-messages/
├── cf7-custom-validation-messages.php    # Main plugin file
├── includes/
│   ├── class-cf7-custom-messages.php            # Core plugin class
│   ├── class-cf7-custom-messages-loader.php     # Hooks loader
│   ├── class-cf7-custom-messages-activator.php  # Activation handler
│   ├── class-cf7-custom-messages-deactivator.php # Deactivation handler
│   └── class-cf7-custom-messages-validator.php  # Validation logic
├── admin/
│   └── class-cf7-custom-messages-admin.php      # Admin interface
└── assets/
    ├── css/
    │   └── cf7-custom-messages-admin.css        # Admin styles
    └── js/
        └── cf7-custom-messages-admin.js         # Admin scripts
```

### Hooks & Filters

The plugin uses the following CF7 hooks:

- `wpcf7_editor_panels` - Adds the Custom Messages tab
- `wpcf7_save_contact_form` - Saves custom messages
- `wpcf7_validate_*` - Applies custom validation messages

### Data Storage

Custom messages are stored as post meta for each form:
- Meta key: `_cf7_custom_validation_messages`
- Format: Serialized array with field names as keys

## Frequently Asked Questions

### Does this work with all Contact Form 7 field types?

Yes, the plugin supports all standard CF7 field types including text, email, tel, textarea, select, checkbox, radio, number, date, url, and acceptance fields.

### Can I use different messages for the same field in different forms?

Yes, custom messages are stored per-form, so each form can have its own set of custom validation messages.

### What happens if I don't set a custom message for a field?

If you don't set a custom message (or leave it empty), Contact Form 7's default validation message will be used for that field.

### Will this plugin slow down my forms?

No, the plugin is lightweight and only loads its resources on the CF7 admin pages. It has minimal impact on form submission performance.

### Can I export/import custom messages?

Currently, custom messages are stored as post meta and will be included if you export/import CF7 forms using CF7's built-in tools.

## Changelog

### 1.0.0
- Initial release
- Custom Messages tab in CF7 editor
- Per-field custom validation messages
- Support for all CF7 field types
- Search and filter functionality
- Visual change indicators

## Support

For bug reports, feature requests, or support questions, please create an issue on the plugin's repository.

## License

This plugin is licensed under the GPL v2 or later.

## Credits

Developed for WordPress and Contact Form 7 users who need more control over form validation messages.

