# Installation Guide - CF7 Custom Validation Messages

This guide will walk you through installing and setting up the CF7 Custom Validation Messages plugin.

## Prerequisites

Before installing this plugin, ensure you have:

1. **WordPress** version 5.0 or higher
2. **PHP** version 7.2 or higher
3. **Contact Form 7** plugin installed and activated

## Installation Methods

### Method 1: Manual Installation (Recommended for Development)

1. **Download/Clone the Plugin**
   ```bash
   cd /path/to/wordpress/wp-content/plugins/
   git clone [repository-url] cf7-custom-validation-messages
   ```
   
   Or manually copy the plugin folder to `wp-content/plugins/`

2. **Verify File Structure**
   
   Ensure your plugin directory has this structure:
   ```
   wp-content/plugins/cf7-custom-validation-messages/
   ├── cf7-custom-validation-messages.php
   ├── includes/
   ├── admin/
   └── assets/
   ```

3. **Activate the Plugin**
   - Log in to your WordPress admin dashboard
   - Navigate to **Plugins > Installed Plugins**
   - Find "CF7 Custom Validation Messages"
   - Click **Activate**

### Method 2: Upload via WordPress Admin

1. **Prepare the Plugin**
   - Create a ZIP file of the entire plugin folder
   - Name it `cf7-custom-validation-messages.zip`

2. **Upload**
   - Log in to WordPress admin
   - Go to **Plugins > Add New**
   - Click **Upload Plugin**
   - Choose the ZIP file
   - Click **Install Now**

3. **Activate**
   - After installation, click **Activate Plugin**

### Method 3: FTP Upload

1. **Upload Files**
   - Connect to your server via FTP
   - Navigate to `/wp-content/plugins/`
   - Upload the `cf7-custom-validation-messages` folder

2. **Set Permissions**
   ```bash
   chmod 755 cf7-custom-validation-messages
   chmod 644 cf7-custom-validation-messages/*.php
   ```

3. **Activate**
   - Go to WordPress admin > Plugins
   - Activate the plugin

## Verification

After activation, verify the installation:

1. **Check for Errors**
   - Look for any error messages in the WordPress admin
   - If you see "CF7 Custom Validation Messages requires Contact Form 7 to be installed and activated", install Contact Form 7 first

2. **Verify the Tab**
   - Go to **Contact > Contact Forms**
   - Edit any form
   - Look for the **"Custom Messages"** tab
   - If you see it, installation is successful!

## First-Time Setup

1. **Edit a Form**
   - Navigate to **Contact > Contact Forms**
   - Click on an existing form (or create a new one)

2. **Add Form Fields**
   - Make sure your form has at least one field
   - Example:
     ```
     [text* your-name]
     [email* your-email]
     [textarea your-message]
     ```

3. **Configure Custom Messages**
   - Click the **"Custom Messages"** tab
   - You'll see all your form fields listed
   - Enter custom validation messages for any fields
   - Example: "Please enter your full name" for the name field

4. **Save the Form**
   - Click **Save** at the bottom of the page
   - Your custom messages are now active!

## Testing

1. **Test Validation**
   - Go to the page where your form is displayed
   - Submit the form without filling required fields
   - You should see your custom validation messages

2. **Debug Issues**
   - If custom messages don't appear, check:
     - Is the form saved after adding custom messages?
     - Is the field name correct?
     - Try clearing your browser cache

## Troubleshooting

### Plugin Won't Activate

**Problem**: Error message about Contact Form 7

**Solution**: Install and activate Contact Form 7 first
```
Plugins > Add New > Search "Contact Form 7" > Install > Activate
```

### Custom Messages Tab Not Showing

**Problem**: Can't find the Custom Messages tab

**Solutions**:
1. Ensure you're editing a CF7 form (not a regular WordPress page)
2. Try deactivating and reactivating the plugin
3. Clear WordPress cache if using a caching plugin
4. Check file permissions

### Custom Messages Not Displaying

**Problem**: Still seeing default CF7 messages

**Solutions**:
1. Verify messages are saved (check Custom Messages tab)
2. Clear browser cache
3. Check for JavaScript errors in browser console
4. Ensure field names match exactly

### File Permission Issues

If you see permission errors:

```bash
cd /path/to/wp-content/plugins/cf7-custom-validation-messages
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
```

## Updating the Plugin

### Manual Update

1. **Backup**
   - Export your forms (Contact > Contact Forms > Export)
   - Note: Custom messages are stored in the database and will be preserved

2. **Replace Files**
   - Deactivate the plugin
   - Delete the old plugin folder
   - Upload the new version
   - Reactivate

3. **Verify**
   - Check that custom messages are still there
   - Test form validation

### Via WordPress (if available)

1. Go to **Plugins > Installed Plugins**
2. If an update is available, click **Update Now**
3. WordPress will handle the update automatically

## Uninstallation

### Clean Removal

1. **Deactivate**
   - Go to **Plugins > Installed Plugins**
   - Click **Deactivate** under CF7 Custom Validation Messages

2. **Delete**
   - Click **Delete**
   - Confirm deletion

3. **Data Removal**
   - The plugin will automatically remove its data from the database
   - Custom messages are deleted permanently

### Manual Cleanup (if needed)

If data persists after uninstallation:

```sql
DELETE FROM wp_postmeta 
WHERE meta_key = '_cf7_custom_validation_messages';
```

## Additional Resources

- **Plugin Documentation**: See README.md
- **Contact Form 7 Docs**: https://contactform7.com/docs/
- **WordPress Codex**: https://codex.wordpress.org/

## Getting Help

If you encounter issues:

1. Check the Troubleshooting section above
2. Review the FAQ in README.md
3. Check WordPress and PHP error logs
4. Ensure all requirements are met

## System Requirements Summary

| Requirement | Minimum Version |
|-------------|----------------|
| WordPress   | 5.0+           |
| PHP         | 7.2+           |
| Contact Form 7 | Latest     |

## File Permissions

Recommended permissions:
- Directories: `755`
- PHP files: `644`

## Security Notes

- The plugin sanitizes all user input
- Custom messages are escaped on output
- Nonce verification is handled by CF7
- No external dependencies required

---

**Installation Complete!** You're ready to create custom validation messages for your Contact Form 7 forms.

