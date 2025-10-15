# Release Instructions

## Automated Release (GitHub Actions)

This plugin uses GitHub Actions to automatically create releases when you push a version tag.

### Steps:

1. **Update Version**
   ```bash
   npm run bump:minor  # or bump:patch or bump:major
   ```

2. **Commit Changes**
   ```bash
   git add .
   git commit -m "Release version X.X.X"
   ```

3. **Create and Push Tag**
   ```bash
   git tag v2.4.0
   git push origin main --tags
   ```

4. **GitHub Actions Will**:
   - Automatically build the plugin
   - Create a GitHub release
   - Attach the ZIP file
   - Generate release notes

---

## Manual Release

If you prefer to create releases manually:

### 1. Build the Plugin

```bash
npm install
npm run build
```

This creates: `dist/cf7-custom-validation-messages-v2.4.0.zip`

### 2. Create GitHub Release

1. Go to: https://github.com/halfcoder/cf7-custom-validation-messages/releases/new
2. Click "Choose a tag" → Create new tag: `v2.4.0`
3. Set release title: `v2.4.0`
4. Add release notes (see template below)
5. Upload the ZIP file from `dist/` folder
6. Click "Publish release"

### Release Notes Template

```markdown
## CF7 Custom Validation Messages v2.4.0

### What's New
- Feature descriptions
- Bug fixes
- Improvements

### Installation
1. Download the ZIP file below
2. Go to WordPress Admin → Plugins → Add New → Upload Plugin
3. Upload the ZIP file and activate

### Requirements
- WordPress 6.7 or higher
- PHP 7.4 or higher
- Contact Form 7 (latest version)

See [CHANGELOG.md](CHANGELOG.md) for complete details.
```

---

## Version Bumping

Use npm scripts to bump versions:

```bash
# Patch: 2.4.0 → 2.4.1 (bug fixes)
npm run bump:patch

# Minor: 2.4.0 → 2.5.0 (new features)
npm run bump:minor

# Major: 2.4.0 → 3.0.0 (breaking changes)
npm run bump:major
```

This automatically updates:
- `package.json`
- `cf7-custom-validation-messages.php`

---

## Pre-Release Checklist

Before creating a release:

- [ ] All features tested and working
- [ ] CHANGELOG.md updated with changes
- [ ] Version bumped in package.json and main PHP file
- [ ] README.md updated if needed
- [ ] No debugging code left in files
- [ ] Build created and tested (`npm run build`)
- [ ] ZIP file tested in clean WordPress install

---

## Post-Release

After creating a release:

1. **Test the release**
   - Download ZIP from GitHub releases
   - Install in a test WordPress site
   - Verify everything works

2. **Announce** (optional)
   - Update your website
   - Social media announcement
   - Email to users

3. **Monitor**
   - Watch for issues on GitHub
   - Check for user feedback

---

## GitHub Repository Setup

Make sure your repository is set up:

1. **Enable GitHub Actions**
   - Go to Settings → Actions → General
   - Allow all actions

2. **Create Repository Secrets** (if needed)
   - GitHub token is automatically available
   - No additional secrets needed for basic releases

3. **Branch Protection** (optional)
   - Protect main branch
   - Require PR reviews
   - Require status checks

---

## Quick Release Workflow

```bash
# 1. Update version
npm run bump:minor

# 2. Update changelog
# Edit CHANGELOG.md manually

# 3. Build and test
npm run build
# Test the ZIP file

# 4. Commit and tag
git add .
git commit -m "Release v2.5.0"
git tag v2.5.0

# 5. Push
git push origin main --tags

# 6. GitHub Actions creates the release automatically!
```

---

For questions: https://halfaccessible.com/contact/

