# Testing Guide - Version 2.0.0 Bug Fixes

## Quick Test - 5 Minutes

Follow these steps to verify the bug fixes work:

---

## Prerequisites

1. WordPress installed and running
2. Contact Form 7 plugin installed and active
3. This plugin (v2.0.0) installed and active

---

## Test 1: Verify Messages Save ✅

### Steps:

1. **Go to WordPress Admin**
   ```
   Dashboard → Contact → Contact Forms
   ```

2. **Edit or Create a Form**
   - If no forms exist, create one with:
   ```
   <label> Your Name (required)
       [text* your-name] </label>

   <label> Your Email (required)
       [email* your-email] </label>

   <label> Message
       [textarea your-message] </label>

   [submit "Send"]
   ```

3. **Click "Custom Messages" Tab**
   - Should be next to Form, Mail, Messages, Additional Settings

4. **Enter Custom Messages**
   ```
   your-name: "Please tell us your name"
   your-email: "We need a valid email address"
   your-message: "Please describe your inquiry"
   ```

5. **Click Save**
   - Scroll down and click the blue "Save" button

6. **Reload the Page** (F5 or Cmd+R)
   - Click back on "Custom Messages" tab if needed

7. **✅ VERIFY: Messages are still there**
   - If you see your messages, this bug is FIXED! ✅
   - If fields are blank, see troubleshooting below ❌

---

## Test 2: Verify Messages Display on Frontend ✅

### Steps:

1. **View the Form on Your Site**
   - Create a page and add your form shortcode: `[contact-form-7 id="123"]`
   - Or find existing page with the form

2. **Leave Required Fields Empty**
   - Don't fill in the name field
   - Don't fill in the email field

3. **Submit the Form**
   - Click the submit button

4. **✅ VERIFY: Custom messages appear**
   - You should see: "Please tell us your name" (not "The field is required")
   - You should see: "We need a valid email address" (not "The email address entered is invalid")
   - If you see your custom messages, this bug is FIXED! ✅

---

## Test 3: Verify Message Clearing Works ✅

### Steps:

1. **Go back to Custom Messages tab**

2. **Clear one message**
   - Delete all text from one field
   - Or click the × button if visible

3. **Save the form**

4. **Reload the page**

5. **✅ VERIFY: Field is empty**
   - If the field is empty, clearing works! ✅

---

## Test 4: Multiple Fields Test ✅

### Steps:

1. **Add custom messages to all fields**

2. **Save**

3. **Submit form on frontend with all fields empty**

4. **✅ VERIFY: All custom messages appear**
   - Each field should show its custom message
   - Not the default CF7 messages

---

## Quick Verification Checklist

Use this checklist to confirm everything works:

### Admin Panel
- [ ] Custom Messages tab is visible
- [ ] Can enter text in message fields
- [ ] Messages persist after clicking Save
- [ ] Messages appear after page reload
- [ ] Can clear messages by deleting text
- [ ] Counter shows correct number of messages

### Frontend
- [ ] Form displays normally
- [ ] Submitting with empty fields shows errors
- [ ] Custom messages appear (not defaults)
- [ ] Multiple field validations work
- [ ] Messages appear in correct location

---

## What Was Fixed

### Bug #1: Messages Not Saving ✅ FIXED
**Problem:** Messages would disappear after saving
**Cause:** CF7 version compatibility issue
**Fix:** Added universal CF7 ID detection

### Bug #2: Messages Not Displaying ✅ FIXED
**Problem:** Custom messages didn't show on frontend
**Cause:** Same CF7 compatibility issue
**Fix:** Same universal ID detection in validator

### Bug #3: Can't Clear Messages ✅ FIXED
**Problem:** Couldn't remove a custom message once set
**Cause:** Save logic only stored non-empty values
**Fix:** Now saves all values including empty ones

---

## If Tests Fail

### Messages Still Not Saving?

1. **Enable Debug Mode**
   Edit `wp-config.php`:
   ```php
   define( 'WP_DEBUG', true );
   define( 'WP_DEBUG_LOG', true );
   define( 'WP_DEBUG_DISPLAY', false );
   ```

2. **Check Debug Log**
   Look in `/wp-content/debug.log` for errors

3. **Verify Plugin Version**
   Check that version shows as `2.0.0` in plugins list

4. **Clear All Caches**
   - WordPress object cache
   - Plugin caches
   - Browser cache

5. **Check Database**
   Run this query in phpMyAdmin:
   ```sql
   SELECT * FROM wp_postmeta 
   WHERE meta_key = '_cf7_custom_validation_messages';
   ```
   You should see your messages stored

### Messages Still Not Displaying?

1. **Test in Incognito/Private Mode**
   - Eliminates browser cache issues

2. **Check Field Names Match**
   - Form field: `[text* your-name]`
   - Must match exactly in Custom Messages

3. **Try Simple Message**
   - Use just "Test" to rule out character issues

4. **Check CF7 Version**
   - Should be 5.0 or higher
   - Check in Plugins list

5. **Disable Other Plugins**
   - Deactivate all except CF7 and this plugin
   - Test again

---

## Database Verification

Want to see if data is actually being saved?

### Method 1: Using WordPress Debug

Add to theme's `functions.php` temporarily:

```php
add_action( 'admin_footer', function() {
    global $post;
    if ( isset( $post->ID ) ) {
        $messages = get_post_meta( $post->ID, '_cf7_custom_validation_messages', true );
        if ( $messages ) {
            echo '<script>console.log(' . json_encode($messages) . ');</script>';
        }
    }
});
```

Check browser console (F12) when editing form.

### Method 2: Direct Database Query

In phpMyAdmin:

```sql
-- Replace 123 with your form's post ID
SELECT meta_value 
FROM wp_postmeta 
WHERE post_id = 123 
AND meta_key = '_cf7_custom_validation_messages';
```

Should show serialized array of your messages.

---

## Performance Test

The fixes should NOT impact performance. Verify:

1. **Admin page loads normally** (no slowdown)
2. **Form submits at normal speed** (no delay)
3. **No JavaScript errors** in browser console

---

## Compatibility Test

Test with different configurations:

### CF7 Versions
- [ ] CF7 5.0 - 5.3 (older method)
- [ ] CF7 5.4 - 5.8 (newer method)
- [ ] Latest CF7 version

### Field Types
- [ ] Text fields (text, text*)
- [ ] Email fields (email, email*)
- [ ] Textarea fields
- [ ] Select dropdowns
- [ ] Checkboxes

### Scenarios
- [ ] New form (never had custom messages)
- [ ] Existing form (had custom messages before)
- [ ] Empty form (no fields)
- [ ] Large form (20+ fields)

---

## Report Issues

If you still have problems after testing:

**Include:**
1. WordPress version
2. PHP version
3. CF7 version
4. Plugin version (should be 2.0.0)
5. Error messages from debug.log
6. Browser console errors
7. Steps to reproduce

**See:**
- TROUBLESHOOTING.md for detailed debugging
- BUGFIX-SUMMARY.md for technical details

---

## Success! ✅

If all tests pass:

✅ **Your plugin is working correctly!**

You can now:
- Use custom messages on all your forms
- Confidently update messages anytime
- Clear messages when needed
- Deploy to production

---

## Build New Version

Want to create a distribution ZIP with the fixes?

```bash
# Install dependencies (if not done already)
npm install

# Create version 2.0.0 ZIP
npm run build
```

Output: `dist/cf7-custom-validation-messages-v2.0.0.zip`

---

## Upgrade from 1.0.0

If you have v1.0.0 installed:

1. **Deactivate** old version
2. **Delete** old plugin folder
3. **Upload** version 2.0.0
4. **Activate** new version
5. **Re-test** your forms

Your messages (if any saved) will be preserved in the database.

---

**Testing Complete!** 🎉

If all tests pass, version 2.0.0 has successfully resolved the reported issues.

For more information:
- **BUGFIX-SUMMARY.md** - What was fixed
- **TROUBLESHOOTING.md** - Debugging guide
- **USAGE-GUIDE.md** - How to use the plugin

**Last Updated:** 2025-10-15  
**Plugin Version:** 2.0.0

