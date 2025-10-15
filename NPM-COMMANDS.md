# NPM Commands - Quick Reference

Quick reference for building and releasing the CF7 Custom Validation Messages plugin.

---

## 🚀 Most Common Commands

### Create Distribution ZIP
```bash
npm run build
```
Creates `dist/cf7-custom-validation-messages-v1.0.0.zip`

### Bump Version & Build
```bash
# Patch (1.0.0 → 1.0.1) for bug fixes
npm run bump:patch && npm run build

# Minor (1.0.0 → 1.1.0) for new features
npm run bump:minor && npm run build

# Major (1.0.0 → 2.0.0) for breaking changes
npm run bump:major && npm run build
```

---

## 📦 Build Commands

| Command | What It Does |
|---------|--------------|
| `npm run build` | Clean dist folder and create versioned ZIP |
| `npm run release` | Same as build with confirmation message |
| `npm run clean` | Delete all ZIPs from dist/ folder |
| `npm run zip` | Create ZIP using Node.js script |
| `npm run zip:manual` | Create ZIP using system zip command |

---

## 🔢 Version Commands

| Command | Example | Use For |
|---------|---------|---------|
| `npm run version` | Shows `1.0.0` | Check current version |
| `npm run bump:patch` | 1.0.0 → 1.0.1 | Bug fixes |
| `npm run bump:minor` | 1.0.0 → 1.1.0 | New features |
| `npm run bump:major` | 1.0.0 → 2.0.0 | Breaking changes |
| `npm run update-plugin-version` | - | Sync version to PHP file |

---

## 📋 Complete Workflows

### Release a Bug Fix (Patch)

```bash
# 1. Bump patch version (1.0.0 → 1.0.1)
npm run bump:patch

# 2. Create distribution ZIP
npm run build

# 3. Test the ZIP
# Extract to WordPress and test

# 4. Commit and tag
git add .
git commit -m "Fix: [description]"
git tag v1.0.1
git push origin main --tags
```

### Release a New Feature (Minor)

```bash
# 1. Bump minor version (1.0.0 → 1.1.0)
npm run bump:minor

# 2. Create distribution ZIP
npm run build

# 3. Test thoroughly
# Test all existing features + new feature

# 4. Commit and tag
git add .
git commit -m "Feature: [description]"
git tag v1.1.0
git push origin main --tags
```

### Release Breaking Changes (Major)

```bash
# 1. Bump major version (1.0.0 → 2.0.0)
npm run bump:major

# 2. Create distribution ZIP
npm run build

# 3. Test extensively
# Ensure migration path for users

# 4. Update CHANGELOG.md with breaking changes

# 5. Commit and tag
git add .
git commit -m "Breaking: [description]"
git tag v2.0.0
git push origin main --tags
```

---

## 🛠️ Setup

### First Time Setup

```bash
# 1. Install Node.js (if not installed)
# Download from https://nodejs.org

# 2. Install dependencies
npm install

# 3. Verify setup
npm run version
```

### What Gets Installed

- `archiver` - Creates ZIP files with compression

---

## 📁 Output Structure

After running `npm run build`:

```
dist/
└── cf7-custom-validation-messages-v1.0.0.zip
    └── cf7-custom-validation-messages/
        ├── cf7-custom-validation-messages.php
        ├── uninstall.php
        ├── includes/
        ├── admin/
        ├── assets/
        ├── README.md
        ├── INSTALLATION.md
        ├── USAGE-GUIDE.md
        └── QUICK-START.md
```

---

## ⚡ Quick Tips

### 1. Check What's in the ZIP
```bash
unzip -l dist/cf7-custom-validation-messages-v1.0.0.zip
```

### 2. Extract ZIP for Testing
```bash
unzip dist/cf7-custom-validation-messages-v1.0.0.zip -d ~/test-wp/wp-content/plugins/
```

### 3. Clean Start
```bash
npm run clean && npm run build
```

### 4. Version Check
```bash
# Check package.json version
npm run version

# Check PHP file version
grep "Version:" cf7-custom-validation-messages.php
```

---

## 🐛 Troubleshooting

### Error: "archiver not found"
**Solution:**
```bash
npm install
```

### Error: "Permission denied"
**Solution (Linux/Mac):**
```bash
chmod +x scripts/*.js
```

### ZIP Missing Files
**Check** `scripts/create-zip.js` to ensure all needed files are included.

### Version Not Syncing
**Manual sync:**
```bash
npm run update-plugin-version
```

### Dist Folder Not Created
**Manual creation:**
```bash
mkdir -p dist
npm run build
```

---

## 🔍 What Each Script Does

### npm run build
1. Runs `clean` (deletes old ZIPs)
2. Creates `dist/` folder
3. Runs `zip` script
4. Creates versioned ZIP file

### npm run bump:patch
1. Increments patch version in `package.json`
2. Runs `update-plugin-version`
3. Updates version in PHP file
4. Updates version constant

### npm run zip
1. Reads version from `package.json`
2. Creates archive with archiver
3. Adds production files only
4. Excludes dev files
5. Compresses to maximum level
6. Outputs to `dist/` folder

---

## 📊 File Sizes

Typical sizes after build:

| Component | Size |
|-----------|------|
| PHP Code | ~20 KB |
| CSS | ~5 KB |
| JavaScript | ~8 KB |
| Documentation | ~40 KB |
| **Total ZIP** | **~50-80 KB** |

---

## 🎯 Best Practices

1. **Always test the ZIP** before releasing
2. **Update CHANGELOG.md** before building
3. **Commit before tagging** your releases
4. **Use semantic versioning** consistently
5. **Test in clean WordPress install** after extracting ZIP

---

## 📚 Related Documentation

- **BUILD.md** - Detailed build documentation
- **CHANGELOG.md** - Version history
- **README.md** - Plugin overview
- **PLUGIN-OVERVIEW.md** - Technical architecture

---

## 🎬 Example Session

```bash
$ cd /path/to/cf7-custom-message

# Check current version
$ npm run version
1.0.0

# Make some bug fixes...
# (edit files, test locally)

# Bump version for bug fix
$ npm run bump:patch
✓ Updated plugin version to 1.0.1

# Create distribution ZIP
$ npm run build
Creating distribution ZIP...
Version: 1.0.1

✓ ZIP created successfully!
  File: cf7-custom-validation-messages-v1.0.1.zip
  Size: 0.05 MB (52428 bytes)
  Path: /path/to/cf7-custom-message/dist/cf7-custom-validation-messages-v1.0.1.zip

# Test the ZIP...

# Commit and tag
$ git add .
$ git commit -m "Fix: Correct validation message display"
$ git tag v1.0.1
$ git push origin main --tags

# Done! 🎉
```

---

**Happy Building!** 🚀

For more details, see **BUILD.md**.

