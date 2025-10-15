# Troubleshooting Guide - CF7 Custom Validation Messages

## Common Issues and Solutions

---

## Issue: Custom Messages Not Saving

### Symptoms
- You enter custom messages in the admin panel
- Click Save
- Messages appear blank when you reload the page

### Solutions

#### 1. Check WordPress Debug
Enable debug mode to see any errors:

```php
// Add to wp-config.php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

Check `/wp-content/debug.log` for errors.

#### 2. Verify Database Storage
Check if data is being saved to the database:

```php
// Add this temporarily to your theme's functions.php
add_action( 'admin_footer', function() {
    if ( isset( $_GET['post'] ) ) {
        $form_id = intval( $_GET['post'] );
        $messages = get_post_meta( $form_id, '_cf7_custom_validation_messages', true );
        echo '<script>console.log("Saved Messages:", ' . json_encode($messages) . ');</script>';
    }
});
```

Then check browser console when editing a form.

#### 3. Check File Permissions
Ensure WordPress can write to the database:

```bash
# Check database connection
wp db check
```

#### 4. Clear All Caches
- Clear WordPress object cache
- Clear any caching plugins (W3 Total Cache, WP Super Cache, etc.)
- Clear browser cache
- Disable caching temporarily for testing

#### 5. Check for Plugin Conflicts
Deactivate all other plugins except CF7 and this plugin, then test.

---

## Issue: Custom Messages Not Displaying on Frontend

### Symptoms
- Messages save correctly in admin
- But default CF7 messages appear on form submission

### Solutions

#### 1. Verify Messages Are Saved
In WordPress admin, go to:
**Contact > Contact Forms > Edit Form > Custom Messages tab**

Check that your messages are displayed in the input fields.

#### 2. Test with Simple Message
Use a very simple message to test:

```
Test message
```

If this works, there might be an issue with special characters.

#### 3. Check Field Names Match Exactly
The field name in your form must match exactly:

**Form tab:**
```
[text* your-name]
```

**Custom Messages tab:**
Field name should show as: `your-name` (not `your_name` or `yourname`)

#### 4. Verify Validation is Failing
The custom message only shows when validation fails:
- For required fields: Leave empty and submit
- For email fields: Enter invalid email like "test"
- For number fields: Enter text instead of numbers

#### 5. Check CF7 Version Compatibility
Ensure you have Contact Form 7 version 5.0 or higher:

```php
// Check CF7 version
echo WPCF7_VERSION;
```

#### 6. Check Browser Console
Open browser developer tools (F12) and check:
- Console for JavaScript errors
- Network tab to see form submission

---

## Debugging Steps

### Step 1: Verify Plugin is Active

```bash
wp plugin list
```

Look for `cf7-custom-validation-messages` with status `active`.

### Step 2: Test with Default Form

Create a simple test form:

```
<label> Your name
    [text* your-name] </label>

<label> Your email
    [email* your-email] </label>

<label> Your message
    [textarea your-message] </label>

[submit "Submit"]
```

Add custom messages:
- your-name: "Please enter your name"
- your-email: "Please provide a valid email"

Test by submitting empty form.

### Step 3: Check Database Directly

Using phpMyAdmin or MySQL command line:

```sql
SELECT * FROM wp_postmeta 
WHERE meta_key = '_cf7_custom_validation_messages';
```

You should see serialized array with your messages.

### Step 4: Enable Detailed Logging

Add this to the validator class temporarily for debugging:

```php
// In class-cf7-custom-messages-validator.php
// At the start of custom_validation_message method

error_log('CF7 Custom Messages Debug:');
error_log('Form ID: ' . $form_id);
error_log('Field Name: ' . $field_name);
error_log('Custom Messages: ' . print_r($custom_messages, true));
error_log('Validation Failed: ' . ($result->is_valid() ? 'No' : 'Yes'));
```

Check `/wp-content/debug.log` after submitting the form.

---

## Known Issues

### Issue: Field Names with Special Characters

**Problem:** Fields with special characters in names might not work

**Solution:** Use only alphanumeric characters and hyphens in field names:
- ✅ Good: `your-name`, `email-address`, `phone1`
- ❌ Bad: `your name`, `email@address`, `phone#1`

### Issue: CF7 Cached Forms

**Problem:** CF7 might cache form output

**Solution:** 
1. Deactivate caching plugins
2. Clear CF7's internal cache
3. Refresh the page in incognito/private mode

### Issue: Theme Conflicts

**Problem:** Some themes override CF7 validation

**Solution:** Switch to a default theme (Twenty Twenty-Three) temporarily to test

### Issue: JavaScript Conflicts

**Problem:** Other plugins' JavaScript interferes

**Solution:** Check browser console for errors, deactivate other plugins one by one

---

## Testing Checklist

Use this checklist to verify everything works:

### Admin Side
- [ ] Plugin is activated
- [ ] Contact Form 7 is activated
- [ ] Custom Messages tab appears in form editor
- [ ] Fields are listed in the table
- [ ] Can type messages into fields
- [ ] Messages persist after clicking Save
- [ ] Messages appear after reloading page

### Frontend Side
- [ ] Form displays on page
- [ ] Can submit form normally
- [ ] Submitting empty required field shows message
- [ ] Custom message appears (not default)
- [ ] Message appears in correct location
- [ ] Multiple field validations work
- [ ] Different forms have different messages

---

## Support Information to Provide

If you need help, please provide:

1. **WordPress Version:** (Dashboard > Updates)
2. **PHP Version:** (Site Health > Info > Server)
3. **CF7 Version:** Check plugins list
4. **Plugin Version:** Check plugins list
5. **Error Messages:** From debug.log
6. **Browser Console Errors:** From developer tools
7. **Form Code:** The form markup from Form tab
8. **Custom Messages:** What messages you set
9. **Expected vs Actual:** What you expect vs what happens
10. **Other Plugins:** List of active plugins

---

## Quick Fixes

### Fix 1: Reset Plugin

```bash
# Deactivate and reactivate
wp plugin deactivate cf7-custom-validation-messages
wp plugin activate cf7-custom-validation-messages
```

### Fix 2: Clear All Custom Messages

To start fresh, run this in phpMyAdmin:

```sql
DELETE FROM wp_postmeta 
WHERE meta_key = '_cf7_custom_validation_messages';
```

### Fix 3: Reinstall Plugin

1. Deactivate plugin
2. Delete plugin folder
3. Upload fresh copy
4. Activate again

(Note: This will NOT delete your custom messages - they're in the database)

---

## Performance Issues

### Issue: Slow Admin Page

**Solutions:**
- Limit number of fields in form (< 50)
- Disable search/filter if not needed
- Check for JavaScript console errors

### Issue: Slow Form Submission

**Solutions:**
- Check if other plugins are slowing down validation
- Disable complex validation rules temporarily
- Check server PHP performance

---

## Additional Resources

- **WordPress Debug:** https://wordpress.org/support/article/debugging-in-wordpress/
- **CF7 Documentation:** https://contactform7.com/docs/
- **Plugin Documentation:** See README.md and USAGE-GUIDE.md

---

## Still Having Issues?

If none of these solutions work:

1. **Enable WP_DEBUG** and check for specific error messages
2. **Test with default WordPress theme** (Twenty Twenty-Three)
3. **Deactivate all other plugins** except CF7
4. **Verify database permissions** are correct
5. **Check PHP error logs** on your server

Provide the information from the "Support Information" section above when seeking help.

---

**Last Updated:** 2025-10-15  
**Plugin Version:** 2.0.0

