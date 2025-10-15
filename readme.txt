=== CF7 Custom Validation Messages ===
Contributors: halfcoder
Tags: contact form 7, cf7, validation, custom messages, error messages
Requires at least: 6.7
Tested up to: 6.8
Stable tag: 2.5.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Extends Contact Form 7 by adding custom validation messages for each field. Replace default CF7 error messages with your own user-friendly messages.

== Description ==

CF7 Custom Validation Messages allows you to define custom validation error messages for each field in your Contact Form 7 forms. Replace the default generic error messages with your own personalized, user-friendly messages to improve the user experience.

= Features =

* Custom Messages tab in Contact Form 7 form editor
* Automatic field detection from CF7 forms
* Per-field custom validation messages
* Support for all CF7 field types (text, email, tel, textarea, select, checkbox, radio, etc.)
* Real-time message counter
* Search/filter for forms with many fields
* Clean, intuitive admin interface
* Works with CF7's AJAX validation
* Responsive design

= Supported Field Types =

* Text fields (text, text*)
* Email fields (email, email*)
* Phone fields (tel, tel*)
* URL fields (url, url*)
* Number fields (number, number*)
* Date fields (date, date*)
* Textarea fields (textarea, textarea*)
* Select dropdowns (select, select*)
* Checkboxes (checkbox, checkbox*)
* Radio buttons (radio)
* Acceptance fields (acceptance)

= How It Works =

The plugin adds a new "Custom Messages" tab to the Contact Form 7 form editor. When you open this tab, you'll see a table listing all the fields in your form. Simply enter your custom validation message for each field, and the plugin will automatically replace CF7's default error messages with your custom messages when validation fails.

= Example =

Default CF7 message: "The field is required."
Your custom message: "Please tell us your name so we can address you properly."

= Requirements =

* WordPress 6.7 or higher
* PHP 7.4 or higher
* Contact Form 7 (latest version)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/cf7-custom-validation-messages` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Make sure Contact Form 7 is installed and activated.
4. Go to Contact > Contact Forms and edit any form.
5. Click on the "Custom Messages" tab.
6. Enter your custom validation messages for each field.
7. Save the form.

== Frequently Asked Questions ==

= Does this work with all Contact Form 7 field types? =

Yes, the plugin supports all standard CF7 field types including text, email, tel, textarea, select, checkbox, radio, number, date, url, and acceptance fields.

= Can I use different messages for the same field in different forms? =

Yes, custom messages are stored per-form, so each form can have its own set of custom validation messages.

= What happens if I don't set a custom message for a field? =

If you don't set a custom message (or leave it empty), Contact Form 7's default validation message will be used for that field.

= Does this affect form performance? =

No, the plugin is lightweight and has minimal impact on form submission performance.

= Where are the custom messages stored? =

Custom messages are stored in the WordPress database as post meta for each Contact Form 7 form.

== Screenshots ==

1. Custom Messages tab in Contact Form 7 editor
2. Field table showing all form fields with custom message inputs
3. Custom validation message displayed on frontend

== Changelog ==

= 2.5.0 =
* Added WordPress.org readme.txt file
* Updated text domain to match plugin slug
* Fixed WordPress.org compatibility
* Updated tested up to WordPress 6.8

= 2.4.0 =
* Production ready release
* Updated author information
* Updated requirements (WordPress 6.7+, PHP 7.4+)
* Cleaned up documentation
* Added GitHub Actions for automated releases

= 2.3.1 =
* CRITICAL FIX: Fixed validation messages display on frontend
* Now using wpcf7_ajax_json_echo filter to modify AJAX response
* Directly replaces messages in invalid_fields array
* Complete rewrite of message replacement approach

= 2.1.0 =
* Fixed frontend validation logic
* Fixed hook priority (now runs at priority 20)
* Improved validation message replacement
* Added DEBUG-VALIDATION.md guide

= 2.0.0 =
* Fixed save functionality
* Fixed CF7 version compatibility
* Fixed message clearing
* Improved form ID retrieval
* Enhanced error handling

= 1.0.0 =
* Initial release
* Custom Messages tab in CF7 editor
* Dynamic field detection
* Support for all CF7 field types

== Upgrade Notice ==

= 2.5.0 =
WordPress.org compatibility update. Fixed text domain and tested up to WordPress 6.8.

= 2.4.0 =
Production ready release with updated requirements. Requires WordPress 6.7+ and PHP 7.4+.

= 2.3.1 =
Critical bug fix for frontend validation. Custom messages now display correctly. Update immediately.

= 2.0.0 =
Major bug fixes for save functionality and CF7 compatibility. Recommended update.

== Additional Info ==

For support, bug reports, or feature requests, please visit:
https://github.com/halfcoderOpenSource/cf7-custom-message

Author: Mohammad Shadab Saifi
Website: https://halfaccessible.com/

