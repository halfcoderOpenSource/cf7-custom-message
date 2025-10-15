# Debug Validation Issues - Quick Guide

## If Custom Messages Still Not Showing

### Step 1: Enable Debug Logging

Add this to your theme's `functions.php` file **temporarily**:

```php
// Debug CF7 Custom Messages
add_filter( 'wpcf7_validate_text*', function( $result, $tag ) {
    error_log( '=== CF7 Custom Messages Debug ===' );
    error_log( 'Field Name: ' . $tag->name );
    error_log( 'Is Valid: ' . ( $result->is_valid() ? 'Yes' : 'No' ) );
    error_log( 'Posted Value: ' . ( isset( $_POST[ $tag->name ] ) ? $_POST[ $tag->name ] : 'EMPTY' ) );
    
    // Check if custom messages exist
    $submission = WPCF7_Submission::get_instance();
    if ( $submission ) {
        $form = $submission->get_contact_form();
        if ( $form ) {
            $form_id = method_exists( $form, 'id' ) ? $form->id() : $form->id;
            $messages = get_post_meta( $form_id, '_cf7_custom_validation_messages', true );
            error_log( 'Custom Messages: ' . print_r( $messages, true ) );
        }
    }
    
    return $result;
}, 999, 2 );
```

### Step 2: Submit Your Form

Submit the form with an empty required field.

### Step 3: Check Debug Log

Look in `/wp-content/debug.log` for output like:

```
=== CF7 Custom Messages Debug ===
Field Name: your-name
Is Valid: No
Posted Value: EMPTY
Custom Messages: Array
(
    [your-name] => Please enter your name
)
```

### Step 4: Analyze Results

**If you see custom messages in the log:**
- Messages ARE being saved ✅
- Issue is with applying them during validation

**If custom messages are empty/not shown:**
- Messages NOT saving properly ❌
- Check admin panel again

**If "Is Valid: Yes" when field is empty:**
- Field might not be marked as required
- Check form syntax: should be `[text* your-name]` (note the *)

---

## Quick Test: Force Custom Message

Add this to `functions.php` to force a custom message:

```php
add_filter( 'wpcf7_validate_text*', function( $result, $tag ) {
    if ( $tag->name === 'your-name' ) {
        $value = isset( $_POST['your-name'] ) ? trim( $_POST['your-name'] ) : '';
        
        if ( empty( $value ) ) {
            $result->invalidate( $tag, 'THIS IS A TEST CUSTOM MESSAGE' );
        }
    }
    return $result;
}, 999, 2 );
```

Submit the form - if you see "THIS IS A TEST CUSTOM MESSAGE", then:
- CF7 validation hooks ARE working ✅
- Issue is with our plugin's message retrieval

---

## Check What CF7 Version You Have

```php
// Add to functions.php temporarily
add_action( 'wp_footer', function() {
    if ( defined( 'WPCF7_VERSION' ) ) {
        echo '<!-- CF7 Version: ' . WPCF7_VERSION . ' -->';
    }
});
```

View page source - look for the comment.

---

## Verify Plugin is Loading

Add to `functions.php`:

```php
add_action( 'plugins_loaded', function() {
    if ( class_exists( 'CF7_Custom_Messages_Validator' ) ) {
        error_log( 'CF7 Custom Messages Plugin: LOADED' );
    } else {
        error_log( 'CF7 Custom Messages Plugin: NOT LOADED' );
    }
});
```

Check debug.log - should say "LOADED".

---

## Check Hooks Are Registered

```php
add_action( 'wp_footer', function() {
    global $wp_filter;
    if ( isset( $wp_filter['wpcf7_validate_text*'] ) ) {
        error_log( 'wpcf7_validate_text* hooks: ' . print_r( $wp_filter['wpcf7_validate_text*'], true ) );
    }
});
```

Should show our plugin's hook in the list.

---

## Manual Test: Directly Call Validator

Add this test to your theme's `functions.php`:

```php
// Test custom messages retrieval
add_action( 'wp_footer', function() {
    if ( is_page() ) { // Only on pages
        // Replace 123 with your actual form ID
        $form_id = 123;
        $messages = get_post_meta( $form_id, '_cf7_custom_validation_messages', true );
        
        echo '<!-- Custom Messages Test: ';
        print_r( $messages );
        echo ' -->';
    }
});
```

View page source - you should see your custom messages in HTML comment.

---

## Common Issues & Solutions

### Issue: Messages in Log But Not Displayed

**Try this:**
1. Check priority of hooks (should be 20 now)
2. Check if another plugin is interfering
3. Try disabling all other plugins except CF7

### Issue: Empty $_POST Data

CF7 might be using different data structure. Check:

```php
add_action( 'wpcf7_before_send_mail', function( $contact_form ) {
    error_log( 'ALL POST DATA: ' . print_r( $_POST, true ) );
});
```

### Issue: Messages Not in Database

Run this SQL query in phpMyAdmin:

```sql
SELECT post_id, meta_value 
FROM wp_postmeta 
WHERE meta_key = '_cf7_custom_validation_messages'
```

Should show your messages.

---

## Quick Fix: Try Alternative Hook

If validation hooks not working, try the spam filter hook:

Add to plugin's validator class:

```php
// Alternative: Use spam filter hook
add_filter( 'wpcf7_spam', function( $spam ) {
    // Your validation logic here
    return $spam;
}, 10, 1 );
```

---

## Nuclear Option: Test with Minimal Code

Create a simple test plugin (`test-cf7-validation.php`):

```php
<?php
/**
 * Plugin Name: Test CF7 Validation
 */

add_filter( 'wpcf7_validate_text*', function( $result, $tag ) {
    error_log( 'TEST HOOK FIRED for: ' . $tag->name );
    
    if ( $tag->name === 'your-name' ) {
        $value = isset( $_POST['your-name'] ) ? $_POST['your-name'] : '';
        if ( empty( $value ) ) {
            $result->invalidate( $tag, 'TEST MESSAGE FROM SIMPLE PLUGIN' );
            error_log( 'Invalidated with test message' );
        }
    }
    
    return $result;
}, 20, 2 );
```

If this works, issue is in our main plugin. If this doesn't work, CF7 hooks aren't firing at all.

---

## Report Back

After testing, provide:

1. CF7 Version number
2. Does test plugin (above) work?
3. What's in debug.log?
4. Do messages appear in database?
5. What priority works? (try 10, 20, 30, 999)

---

## Remove Debug Code

After testing, **REMOVE ALL debug code** from functions.php!

```php
// Remove these lines:
// - error_log() calls
// - Test functions
// - Debug filters
```

---

**This debug guide helps identify WHERE the problem is in the validation chain.**

