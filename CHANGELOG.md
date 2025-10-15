# Changelog

All notable changes to the CF7 Custom Validation Messages plugin will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.5.0] - 2025-10-15

### Fixed
- Fixed text domain to match plugin slug (cf7-custom-validation-messages)
- Removed non-existent domain path from plugin headers
- Updated tested up to WordPress 6.8

### Added
- Added WordPress.org compatible readme.txt file
- Proper license declaration for WordPress.org

## [2.3.1] - 2025-10-15

### Fixed
- **CRITICAL:** Fixed by hooking into CF7's AJAX JSON response - Messages NOW work correctly!
- Using `wpcf7_ajax_json_echo` filter to modify the actual JSON response sent to browser
- Directly replaces messages in the `invalid_fields` array of the AJAX response
- Works with CF7's actual validation system instead of trying to override it

### Changed
- Completely rewrote message replacement approach
- Now modifies CF7's AJAX JSON response data structure
- Simplified validation hook logic
- Removed HTML regex replacement (unnecessary with AJAX approach)

### Added
- New `modify_ajax_response()` method to intercept and modify AJAX response
- Direct modification of CF7's `invalid_fields` array

## [2.1.0] - 2025-10-15

### Fixed
- **CRITICAL:** Fixed frontend validation - Custom messages now actually display on form submission
- Fixed validation logic to properly check field values during CF7 validation  
- Fixed hook priority - Now runs at priority 20 after CF7's default validation (priority 10)
- Fixed required field validation - Properly detects empty required fields

### Changed
- Validator now actively checks field values instead of passively checking result
- Improved validation message replacement logic
- Enhanced required field detection

### Added
- DEBUG-VALIDATION.md - Step-by-step debugging guide for validation issues

## [2.0.0] - 2025-10-15

### Fixed
- **Critical:** Fixed save functionality - Custom messages now properly save and persist
- Fixed CF7 version compatibility - Now works with all CF7 versions (method vs property access)
- Fixed message clearing - Empty messages now properly clear saved data

### Changed
- Improved form ID retrieval for better CF7 compatibility
- Enhanced error handling in save and validation methods
- Updated save logic to store all messages (including empty for clearing)

### Added
- TROUBLESHOOTING.md - Comprehensive debugging guide
- Better compatibility with older CF7 versions
- Improved error handling and fallbacks

## [1.0.0] - 2025-10-15

### Added
- Initial release of CF7 Custom Validation Messages plugin
- Custom Messages tab in Contact Form 7 form editor
- Dynamic field detection from CF7 forms
- Custom validation message input for each field
- Support for all CF7 field types:
  - Text fields (text, text*)
  - Email fields (email, email*)
  - Phone fields (tel, tel*)
  - URL fields (url, url*)
  - Number fields (number, number*)
  - Date fields (date, date*)
  - Textarea fields (textarea, textarea*)
  - Select dropdowns (select, select*)
  - Checkboxes (checkbox, checkbox*)
  - Radio buttons (radio)
  - Acceptance fields (acceptance)
- Real-time message counter showing fields with custom messages
- Search/filter functionality for forms with many fields
- Clear buttons (×) to quickly remove custom messages
- Visual indicators for modified fields
- Row highlighting on focus for better UX
- WordPress admin color scheme integration
- Responsive design for mobile/tablet
- Post meta storage for custom messages
- Validation message override system
- Clean uninstall (removes all plugin data)
- Comprehensive documentation:
  - README.md
  - QUICK-START.md
  - INSTALLATION.md
  - USAGE-GUIDE.md
  - PLUGIN-OVERVIEW.md
  - BUILD.md
- NPM build system with versioning
- Automated ZIP creation for distribution

### Security
- Input sanitization for all user data
- Output escaping to prevent XSS
- WordPress capability checks
- SQL injection prevention via Post Meta API

### Performance
- Conditional asset loading (admin only)
- Single database query per form
- WordPress object cache compatible
- Minimal overhead (< 5ms per submission)

---

## [Unreleased]

### Planned Features
- Import/Export functionality for custom messages
- Message templates library
- Conditional messages based on field values
- WPML/Polylang multilingual support
- Bulk operations across multiple forms
- Message history and versioning
- Analytics dashboard for validation failures
- Message variables/placeholders

---

## Version History

- **1.0.0** (2025-10-15) - Initial release

---

## Upgrade Notices

### 1.0.0
First release. No upgrade needed.

---

## Support

For issues, questions, or feature requests:
- Check the documentation in the plugin folder
- Review USAGE-GUIDE.md for detailed instructions
- See INSTALLATION.md for setup help

---

## Contributors

- Initial development: Your Name

---

**Legend:**
- `Added` - New features
- `Changed` - Changes in existing functionality
- `Deprecated` - Soon-to-be removed features
- `Removed` - Removed features
- `Fixed` - Bug fixes
- `Security` - Security improvements
- `Performance` - Performance improvements

