#!/usr/bin/env node

/**
 * Update plugin version in the main PHP file
 * Syncs version from package.json
 */

const fs = require('fs');
const path = require('path');

// Read package.json
const packageJson = JSON.parse(
    fs.readFileSync(path.join(__dirname, '../package.json'), 'utf8')
);

const newVersion = packageJson.version;

// Path to main plugin file
const pluginFile = path.join(__dirname, '../cf7-custom-validation-messages.php');

// Read plugin file
let pluginContent = fs.readFileSync(pluginFile, 'utf8');

// Update Version in plugin header
pluginContent = pluginContent.replace(
    /Version:\s*[\d.]+/,
    `Version: ${newVersion}`
);

// Update version constant
pluginContent = pluginContent.replace(
    /define\(\s*'CF7_CUSTOM_MESSAGES_VERSION',\s*'[\d.]+'\s*\);/,
    `define( 'CF7_CUSTOM_MESSAGES_VERSION', '${newVersion}' );`
);

// Write updated content
fs.writeFileSync(pluginFile, pluginContent, 'utf8');

console.log(`\n✓ Updated plugin version to ${newVersion}`);
console.log(`  File: cf7-custom-validation-messages.php\n`);

