# Usage Guide - CF7 Custom Validation Messages

This comprehensive guide explains how to use the CF7 Custom Validation Messages plugin effectively.

## Table of Contents

1. [Quick Start](#quick-start)
2. [Understanding the Interface](#understanding-the-interface)
3. [Common Use Cases](#common-use-cases)
4. [Advanced Features](#advanced-features)
5. [Best Practices](#best-practices)
6. [Examples](#examples)

---

## Quick Start

### Step 1: Access the Custom Messages Tab

1. Log in to WordPress admin
2. Navigate to **Contact > Contact Forms**
3. Click on any existing form or create a new one
4. Look for the **"Custom Messages"** tab (last tab in the row)
5. Click on it

### Step 2: Set Your First Custom Message

1. Find a field in the table (e.g., "your-name")
2. Enter a custom message in the text box
3. Example: "Please tell us your name so we can respond properly"
4. Click **Save** at the bottom of the page

### Step 3: Test It

1. View your form on the frontend
2. Try submitting without filling the field
3. You should see your custom message!

---

## Understanding the Interface

### The Custom Messages Table

The main interface is a table with three columns:

#### 1. Field Name Column
- Shows the `name` attribute of each field
- Example: `your-name`, `your-email`, `your-message`
- Fields marked with ***** are required fields

#### 2. Field Type Column
- Displays the field type with a colored badge
- Examples: TEXT, EMAIL, TEXTAREA, SELECT, etc.
- Helps you identify what kind of field it is

#### 3. Custom Validation Message Column
- Text input where you enter your custom message
- Placeholder text: "Enter custom message (leave empty for default)"
- Leave empty to use CF7's default message

### Additional Interface Elements

**Message Counter** (appears after you add messages)
- Shows how many fields have custom messages
- Example: "3 of 8 fields have custom messages"
- Helps you track your progress

**Search/Filter Box** (appears for forms with 5+ fields)
- Quickly find specific fields
- Searches both field names and types
- Real-time filtering as you type

**Clear Buttons** (× icon)
- Appears when a field has a custom message
- Click to quickly clear that message
- Red circular button on the right side

---

## Common Use Cases

### Use Case 1: Required Field Messages

**Scenario**: You want friendlier "required field" messages

**Default CF7 Message**: "The field is required."

**Custom Messages**:
```
Name field: "We'd love to know your name!"
Email field: "Please share your email so we can respond"
Message field: "Don't forget to tell us what you need help with"
```

### Use Case 2: Format Validation Messages

**Scenario**: Better error messages for format validation

**For Email Field**:
- Default: "The email address entered is invalid."
- Custom: "Please enter a valid email address (e.g., name@example.com)"

**For Phone Field**:
- Default: "The telephone number is invalid."
- Custom: "Please enter a valid phone number with area code"

**For URL Field**:
- Default: "The URL is invalid."
- Custom: "Please enter a complete website URL starting with http:// or https://"

### Use Case 3: Multilingual Forms

**Scenario**: Forms in different languages

**English Form**:
```
your-name: "Please enter your name"
your-email: "Please provide your email address"
```

**Spanish Form**:
```
your-name: "Por favor ingrese su nombre"
your-email: "Por favor proporcione su dirección de correo electrónico"
```

### Use Case 4: Context-Specific Messages

**Contact Form**:
```
your-name: "Please tell us who you are"
your-message: "We need to know how we can help you"
```

**Job Application Form**:
```
your-name: "Please enter your full legal name"
resume-upload: "Please attach your resume"
cover-letter: "A cover letter helps us understand your interest"
```

---

## Advanced Features

### Dynamic Field Detection

The plugin automatically:
- Scans your form on every page load
- Detects new fields you add
- Updates the field list in real-time
- Removes deleted fields from the list

**How to use**:
1. Add a new field to your form in the "Form" tab
2. Switch to the "Custom Messages" tab
3. The new field will be there automatically!

### Field Type Support

All CF7 field types are supported:

| Field Type | Validates For |
|------------|---------------|
| text, text* | Required, Min/Max length |
| email, email* | Required, Email format |
| tel, tel* | Required, Phone format |
| url, url* | Required, URL format |
| number, number* | Required, Number format, Min/Max value |
| date, date* | Required, Date format |
| textarea, textarea* | Required, Min/Max length |
| select, select* | Required, Valid option |
| checkbox, checkbox* | Required, Valid option |
| radio | Required, Valid option |
| acceptance | Must be checked |

### Visual Feedback

**Row Highlighting**:
- Click on any input field
- The entire row gets a light blue background
- Helps you focus on the current field

**Change Indicators**:
- Modified fields get a blue border
- Shows which messages you've changed since loading
- Helps prevent accidental overwrites

**Counter Updates**:
- Updates in real-time as you type
- Shows progress immediately
- No need to save to see the count

---

## Best Practices

### 1. Keep Messages User-Friendly

**Bad**: "Field validation failed"
**Good**: "Please enter your email address so we can respond to you"

**Bad**: "Invalid input"
**Good**: "This doesn't look like a valid phone number. Please try again."

### 2. Be Specific About Requirements

**Generic**: "Please fill this field"
**Specific**: "Please enter your full name (first and last)"

**Generic**: "Invalid format"
**Specific**: "Please enter your phone number like this: (555) 123-4567"

### 3. Use Positive Language

**Negative**: "Don't leave this empty"
**Positive**: "We need this information to process your request"

**Negative**: "You must accept"
**Positive**: "Please accept the terms to continue"

### 4. Consider Your Audience

**Professional/Business**:
```
"Please provide your business email address"
"Enter your company name for our records"
```

**Casual/Friendly**:
```
"What's your name?"
"Drop us your email so we can chat!"
```

**Technical/Support**:
```
"Please provide detailed information about the issue"
"Enter your product serial number (found on the bottom of the device)"
```

### 5. Test Your Messages

1. Fill out the form correctly ✓
2. Submit with empty required fields
3. Submit with invalid formats (bad email, etc.)
4. Check that messages make sense in context
5. Ask a colleague to try the form

### 6. Don't Overdo It

- You don't need custom messages for every field
- Focus on fields where users commonly make mistakes
- Simple fields can use default messages

---

## Examples

### Example 1: Basic Contact Form

```html
<!-- Form Fields -->
[text* your-name]
[email* your-email]
[tel your-phone]
[textarea* your-message]
```

**Custom Messages**:
```
your-name: "Please tell us your name"
your-email: "We need your email to send you a reply"
your-phone: "Phone number is optional but helps us reach you faster"
your-message: "Please describe what you need help with"
```

### Example 2: Registration Form

```html
<!-- Form Fields -->
[text* first-name]
[text* last-name]
[email* user-email]
[password* user-password]
[acceptance terms] I accept the terms
```

**Custom Messages**:
```
first-name: "First name is required for registration"
last-name: "Last name is required for registration"
user-email: "Enter a valid email - this will be your username"
user-password: "Choose a strong password (minimum 8 characters)"
terms: "You must accept our terms and conditions to register"
```

### Example 3: Quote Request Form

```html
<!-- Form Fields -->
[text* company-name]
[email* contact-email]
[tel* contact-phone]
[select* service "Web Design" "SEO" "Marketing"]
[number* budget min:500]
[date* project-start]
[textarea* project-details]
```

**Custom Messages**:
```
company-name: "Please provide your company name"
contact-email: "Enter your business email address"
contact-phone: "We'll call this number to discuss your project"
service: "Please select the service you're interested in"
budget: "Please enter your budget (minimum $500)"
project-start: "When would you like to start this project?"
project-details: "Tell us more about your project so we can provide an accurate quote"
```

### Example 4: Support Ticket Form

```html
<!-- Form Fields -->
[text* ticket-subject]
[email* user-email]
[select* priority "Low" "Medium" "High" "Critical"]
[select* category "Bug" "Feature Request" "Question"]
[textarea* issue-description]
[file* screenshot]
```

**Custom Messages**:
```
ticket-subject: "Please provide a brief subject for your ticket"
user-email: "We'll send updates to this email address"
priority: "How urgent is this issue?"
category: "What type of issue are you reporting?"
issue-description: "Please describe the issue in detail, including steps to reproduce"
screenshot: "Please attach a screenshot showing the issue"
```

---

## Tips & Tricks

### Tip 1: Copy Messages Between Forms

1. Go to form A, copy all messages to a text file
2. Create/edit form B with similar fields
3. Paste messages into corresponding fields
4. Adjust as needed

### Tip 2: Use the Search Feature

For large forms (10+ fields):
1. Type the field name in the search box
2. The table filters instantly
3. Edit the message
4. Clear search to see all fields again

### Tip 3: Save Frequently

- Custom messages are only saved when you click "Save"
- There's a browser warning if you try to leave with unsaved changes
- Get in the habit of saving after each set of changes

### Tip 4: Test in Incognito Mode

- Clear cookies and cache don't always work
- Test validation in an incognito/private window
- This ensures you see the messages as new users will

### Tip 5: Keep a Template

Create a document with your standard messages:
```
Name field: "Please enter your full name"
Email field: "Please provide a valid email address"
Phone field: "Phone number is optional"
Message field: "Please describe your inquiry"
```

Copy and paste these into new forms for consistency.

---

## Troubleshooting

### Problem: Messages Not Saving

**Solution**:
1. Make sure you click the main "Save" button
2. Check for JavaScript errors in the browser console
3. Ensure you have permission to edit the form

### Problem: Wrong Message Appears

**Solution**:
1. Check the field name matches exactly
2. Field names are case-sensitive
3. Look for duplicate field names in your form

### Problem: Table is Empty

**Solution**:
1. Add fields to your form first
2. Switch to the "Form" tab and add at least one input field
3. Return to "Custom Messages" - fields should appear

### Problem: Can't Find a Field

**Solution**:
1. Use the search/filter box
2. Check if the field exists in the "Form" tab
3. Some field types (like submit buttons) won't appear

---

## Video Walkthrough (Conceptual)

### 1. Installation & Activation (2 minutes)
- Installing the plugin
- Activating it
- Verifying CF7 is installed

### 2. Basic Setup (3 minutes)
- Opening a form
- Finding the Custom Messages tab
- Adding your first message
- Testing it on the frontend

### 3. Advanced Usage (5 minutes)
- Using the search feature
- Clearing messages
- Working with different field types
- Testing validation

---

## Keyboard Shortcuts

While in the Custom Messages tab:

- **Tab** - Move to next message field
- **Shift + Tab** - Move to previous field
- **Ctrl/Cmd + S** - Save form (if supported by browser)
- **Escape** - Clear search filter (if search is active)

---

## Support & Resources

- **Documentation**: See README.md
- **Installation**: See INSTALLATION.md
- **Contact Form 7 Docs**: https://contactform7.com/
- **WordPress Support**: https://wordpress.org/support/

---

**Happy Customizing!** Your form validation messages just got a whole lot friendlier. 🎉

