# Quick Start Guide - CF7 Custom Validation Messages

Get up and running in 5 minutes! 🚀

## What You Need

- WordPress site (5.0+)
- Contact Form 7 plugin installed
- This plugin installed

---

## Step 1: Install the Plugin (2 minutes)

### Option A: Manual Upload
1. Copy `cf7-custom-validation-messages` folder to `/wp-content/plugins/`
2. Go to WordPress Admin → Plugins
3. Find "CF7 Custom Validation Messages"
4. Click **Activate**

### Option B: ZIP Upload
1. Zip the plugin folder
2. WordPress Admin → Plugins → Add New → Upload Plugin
3. Choose ZIP file → Install Now
4. Click **Activate**

**✓ Done!** You should see a success message.

---

## Step 2: Access the Custom Messages Tab (30 seconds)

1. Go to **Contact → Contact Forms**
2. Click on any form (or create a new one)
3. Look for the **"Custom Messages"** tab at the top
4. Click it!

**✓ You should now see a table with all your form fields.**

---

## Step 3: Add Your First Custom Message (1 minute)

Let's customize a required name field:

1. Find the row with your name field (e.g., "your-name")
2. In the "Custom Validation Message" column, type:
   ```
   Please tell us your name so we can address you properly
   ```
3. Scroll down and click **Save**

**✓ Your custom message is now saved!**

---

## Step 4: Test It! (1 minute)

1. Open your contact form on the frontend of your site
2. Leave the name field empty
3. Click Submit

**✓ You should see your custom message instead of the default CF7 message!**

---

## Next Steps

### Add More Custom Messages

Now that you've got one working, add messages for other fields:

**Email field:**
```
We need your email address to send you a reply
```

**Phone field:**
```
Please include your area code (optional but helpful!)
```

**Message field:**
```
Please describe what you need help with in detail
```

### Pro Tips

1. **Leave fields blank** for default messages (you don't have to customize everything)
2. **Be friendly** - users respond better to helpful messages
3. **Be specific** - tell users exactly what you need
4. **Use the search** - filter fields if you have many

---

## Common Questions

**Q: Do I need to add a message for every field?**  
A: No! Only customize fields where you want different messages.

**Q: What if I want the default message back?**  
A: Just clear the message field and save.

**Q: Will this work with required fields (field*)?**  
A: Yes! Works with both required and optional fields.

**Q: Can I use this on multiple forms?**  
A: Absolutely! Each form has its own set of custom messages.

---

## Troubleshooting

### I don't see the Custom Messages tab
- Make sure Contact Form 7 is installed and active
- Try deactivating and reactivating this plugin
- Clear your browser cache

### My custom messages aren't showing
- Did you click Save after entering messages?
- Are you testing the correct form?
- Try clearing your browser cache

### The table is empty
- Add fields to your form first (text, email, textarea, etc.)
- Switch back to the Custom Messages tab

---

## Example: Complete Contact Form

Here's a full example to get you started:

### Form Fields (Form tab):
```
<label> Your Name (required)
    [text* your-name] </label>

<label> Your Email (required)
    [email* your-email] </label>

<label> Phone
    [tel your-phone] </label>

<label> Your Message
    [textarea your-message] </label>

[submit "Send"]
```

### Custom Messages (Custom Messages tab):

| Field | Custom Message |
|-------|----------------|
| your-name | Please tell us your name so we know who to respond to |
| your-email | We need a valid email address to send our reply |
| your-phone | Phone is optional, but helpful if we need to call you |
| your-message | Please describe your inquiry in detail |

### Result:
When users submit incorrectly, they see your friendly custom messages instead of generic ones!

---

## What's Next?

- Read **USAGE-GUIDE.md** for advanced features
- Check **INSTALLATION.md** for detailed setup
- See **README.md** for full documentation

---

## Need Help?

- Check the FAQ in README.md
- Review the full USAGE-GUIDE.md
- Look at PLUGIN-OVERVIEW.md for technical details

---

**That's it!** You're now customizing your Contact Form 7 validation messages. 🎉

Enjoy making your forms more user-friendly!

