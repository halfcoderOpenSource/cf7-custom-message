# CF7 Custom Validation Messages

A WordPress plugin that extends Contact Form 7 by allowing you to define custom validation messages for each field. Replace default CF7 error messages with your own user-friendly messages.

## Description

This plugin adds a new "Custom Messages" tab to the Contact Form 7 form editor, where you can easily customize validation error messages for each field in your forms. This gives you complete control over the error messages displayed to your users when form validation fails.

## Features

- ✅ Custom Messages tab in Contact Form 7 form editor
- ✅ Automatic field detection from CF7 forms
- ✅ Per-field custom validation messages
- ✅ Support for all CF7 field types (text, email, tel, textarea, select, checkbox, radio, etc.)
- ✅ Real-time message counter
- ✅ Search/filter for forms with many fields
- ✅ Clean, intuitive admin interface
- ✅ Works with CF7's AJAX validation
- ✅ Responsive design

## Requirements

- **WordPress:** 6.7 or higher
- **PHP:** 7.4 or higher
- **Contact Form 7:** Latest version (required)

## Installation

### From GitHub Release

1. Download the latest release ZIP file from [GitHub Releases](https://github.com/halfcoder/cf7-custom-validation-messages/releases)
2. Go to WordPress Admin → Plugins → Add New → Upload Plugin
3. Choose the downloaded ZIP file
4. Click "Install Now"
5. Activate the plugin

### From Source

1. Clone this repository:
   ```bash
   git clone https://github.com/halfcoder/cf7-custom-validation-messages.git
   ```

2. Copy to WordPress plugins directory:
   ```bash
   cp -r cf7-custom-validation-messages /path/to/wordpress/wp-content/plugins/
   ```

3. Go to WordPress Admin → Plugins
4. Activate "CF7 Custom Validation Messages"

## Usage

### Basic Setup

1. Go to **Contact → Contact Forms** in WordPress admin
2. Edit any existing form or create a new one
3. Click on the **"Custom Messages"** tab
4. You'll see a table listing all fields in your form
5. Enter custom validation messages for the fields you want to customize
6. Click **Save**

### Example

**Form Field:**
```
[text* your-name]
```

**Custom Message:**
```
Please tell us your name so we can address you properly
```

**Result:** When users submit the form without filling the name field, they'll see your custom message instead of "The field is required."

### Supported Field Types

- Text fields (`text`, `text*`)
- Email fields (`email`, `email*`)
- Phone fields (`tel`, `tel*`)
- URL fields (`url`, `url*`)
- Number fields (`number`, `number*`)
- Date fields (`date`, `date*`)
- Textarea fields (`textarea`, `textarea*`)
- Select dropdowns (`select`, `select*`)
- Checkboxes (`checkbox`, `checkbox*`)
- Radio buttons (`radio`)
- Acceptance fields (`acceptance`)

## Screenshots

### Custom Messages Tab
The plugin adds a new tab to the CF7 editor where you can manage all your custom messages.

### Field Table
All form fields are automatically detected and displayed with their type and required status.

## Frequently Asked Questions

### Does this work with all Contact Form 7 field types?

Yes, the plugin supports all standard CF7 field types including text, email, tel, textarea, select, checkbox, radio, number, date, url, and acceptance fields.

### Can I use different messages for the same field in different forms?

Yes, custom messages are stored per-form, so each form can have its own set of custom validation messages.

### What happens if I don't set a custom message for a field?

If you don't set a custom message (or leave it empty), Contact Form 7's default validation message will be used for that field.

### Does this affect form performance?

No, the plugin is lightweight and has minimal impact on form submission performance (< 5ms per form).

## How It Works

The plugin hooks into Contact Form 7's AJAX validation system and replaces the default error messages with your custom messages in the JSON response. This ensures that your custom messages are displayed correctly on the frontend.

### Technical Flow

1. User submits form
2. CF7 validates fields
3. CF7 prepares AJAX JSON response
4. **Our plugin intercepts the response** (`wpcf7_ajax_json_echo` filter)
5. Replaces default messages with custom messages
6. Modified response is sent to browser
7. User sees custom messages

## Support

For bug reports, feature requests, or support:

- **GitHub Issues:** [Create an issue](https://github.com/halfcoder/cf7-custom-validation-messages/issues)
- **Email:** Via [contact form](https://halfaccessible.com/contact/)

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This plugin is licensed under the GPL v2 or later.

```
Copyright (C) 2025 Mohammad Shadab Saifi

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## Credits

**Author:** Mohammad Shadab Saifi  
**Website:** [halfaccessible.com](https://halfaccessible.com/)  
**Version:** 2.4.0

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history and updates.

---

Made with ❤️ by [Mohammad Shadab Saifi](https://halfaccessible.com/)
