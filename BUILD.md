# Build & Release Guide

This guide explains how to build and create distribution packages for the CF7 Custom Validation Messages plugin.

## Prerequisites

- Node.js (v14 or higher)
- npm (comes with Node.js)

## Initial Setup

Install dependencies:

```bash
npm install
```

This installs the `archiver` package needed for creating ZIP files.

---

## Creating a Distribution ZIP

### Quick Build

To create a distribution ZIP with the current version:

```bash
npm run build
```

This will:
1. Clean any existing ZIPs in `dist/`
2. Create a new ZIP file named: `cf7-custom-validation-messages-v1.0.0.zip`
3. Include only production files (excludes dev files)

**Output**: `dist/cf7-custom-validation-messages-v1.0.0.zip`

### Create Release Package

```bash
npm run release
```

Same as build, but with a confirmation message.

---

## Version Management

### Check Current Version

```bash
npm run version
```

Shows the current version from `package.json`.

### Bump Version

The plugin uses semantic versioning (MAJOR.MINOR.PATCH):

#### Patch Version (1.0.0 → 1.0.1)
For bug fixes:
```bash
npm run bump:patch
```

#### Minor Version (1.0.0 → 1.1.0)
For new features (backward compatible):
```bash
npm run bump:minor
```

#### Major Version (1.0.0 → 2.0.0)
For breaking changes:
```bash
npm run bump:major
```

**What happens:**
1. Updates version in `package.json`
2. Updates version in main plugin PHP file
3. Updates the version constant

### Manual Version Update

Edit `package.json`:
```json
{
  "version": "1.1.0"
}
```

Then sync to PHP file:
```bash
npm run update-plugin-version
```

---

## Complete Release Workflow

### For a New Release:

1. **Make your changes** (code, docs, etc.)

2. **Bump the version**:
   ```bash
   npm run bump:minor  # or patch/major
   ```

3. **Build the distribution ZIP**:
   ```bash
   npm run build
   ```

4. **Test the ZIP**:
   - Extract the ZIP to a test WordPress install
   - Activate and test functionality

5. **Commit changes**:
   ```bash
   git add .
   git commit -m "Release version 1.1.0"
   git tag v1.1.0
   git push origin main --tags
   ```

6. **Upload to WordPress.org** (if applicable):
   - Use the ZIP file in `dist/` folder

---

## Build Scripts Reference

| Script | Command | Description |
|--------|---------|-------------|
| **build** | `npm run build` | Create distribution ZIP |
| **release** | `npm run release` | Build with confirmation |
| **clean** | `npm run clean` | Remove old ZIPs from dist/ |
| **version** | `npm run version` | Show current version |
| **bump:patch** | `npm run bump:patch` | Increment patch version |
| **bump:minor** | `npm run bump:minor` | Increment minor version |
| **bump:major** | `npm run bump:major` | Increment major version |
| **zip:manual** | `npm run zip:manual` | Alternative ZIP method (uses system zip) |

---

## What Gets Included in the ZIP?

### ✅ Included Files:
- `cf7-custom-validation-messages.php` (main file)
- `uninstall.php`
- `includes/` directory
- `admin/` directory
- `assets/` directory
- `README.md`
- `INSTALLATION.md`
- `USAGE-GUIDE.md`
- `QUICK-START.md`

### ❌ Excluded Files:
- `.git/` and `.gitignore`
- `node_modules/`
- `dist/` (build output)
- `scripts/` (build scripts)
- `package.json` and `package-lock.json`
- `.DS_Store` (Mac system files)
- `.vscode/` and `.idea/` (IDE configs)
- `*.log` files

---

## Manual ZIP Creation

If you prefer to create the ZIP manually without npm:

### Linux/Mac:
```bash
zip -r cf7-custom-validation-messages-v1.0.0.zip \
  cf7-custom-validation-messages.php \
  uninstall.php \
  includes/ \
  admin/ \
  assets/ \
  README.md \
  INSTALLATION.md \
  USAGE-GUIDE.md \
  QUICK-START.md
```

### Windows PowerShell:
```powershell
Compress-Archive -Path cf7-custom-validation-messages.php,uninstall.php,includes,admin,assets,*.md -DestinationPath cf7-custom-validation-messages-v1.0.0.zip
```

---

## Troubleshooting

### "archiver not found"

Install dependencies:
```bash
npm install
```

### "Permission denied" on scripts

Make scripts executable (Linux/Mac):
```bash
chmod +x scripts/*.js
```

### ZIP is too large

Check what's included:
```bash
unzip -l dist/cf7-custom-validation-messages-v1.0.0.zip
```

Ensure `node_modules/` is excluded.

### Version not updating in PHP file

Manually run:
```bash
npm run update-plugin-version
```

Check that `cf7-custom-validation-messages.php` has write permissions.

---

## Distribution Checklist

Before releasing:

- [ ] Code is tested and working
- [ ] Version bumped in package.json
- [ ] Version synced to PHP file
- [ ] Documentation updated
- [ ] Changelog updated (if you have one)
- [ ] Build created (`npm run build`)
- [ ] ZIP tested in clean WordPress install
- [ ] Git committed and tagged
- [ ] ZIP uploaded to distribution channel

---

## CI/CD Integration

### GitHub Actions Example

Create `.github/workflows/release.yml`:

```yaml
name: Create Release

on:
  push:
    tags:
      - 'v*'

jobs:
  build:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup Node.js
      uses: actions/setup-node@v3
      with:
        node-version: '18'
    
    - name: Install dependencies
      run: npm install
    
    - name: Build plugin
      run: npm run build
    
    - name: Create Release
      uses: softprops/action-gh-release@v1
      with:
        files: dist/*.zip
      env:
        GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}
```

---

## Advanced: Custom Build

To customize the build process, edit `scripts/create-zip.js`:

```javascript
// Add additional files
archive.file('CHANGELOG.md', { 
    name: `${pluginName}/CHANGELOG.md` 
});

// Add additional directories
archive.directory('languages/', `${pluginName}/languages`);

// Exclude specific files from a directory
archive.glob('assets/**/*', {
    ignore: ['assets/**/*.scss'] // Exclude SCSS files
});
```

---

## File Size Optimization

Current build size: ~50-100 KB (depending on documentation)

To reduce size:
1. Minify CSS/JS (add build step)
2. Remove extensive documentation from ZIP
3. Use `.zipignore` file for granular control

---

## Questions?

- **Technical issues**: See PLUGIN-OVERVIEW.md
- **General help**: See README.md
- **Installation**: See INSTALLATION.md

---

**Happy Building!** 🚀

