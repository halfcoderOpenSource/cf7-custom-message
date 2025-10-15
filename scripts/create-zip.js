#!/usr/bin/env node

/**
 * Create a distribution ZIP file for the WordPress plugin
 * Includes versioning and excludes development files
 */

const fs = require('fs');
const path = require('path');
const archiver = require('archiver');

// Read package.json to get version
const packageJson = JSON.parse(
    fs.readFileSync(path.join(__dirname, '../package.json'), 'utf8')
);

const version = packageJson.version;
const pluginName = packageJson.name;

// Create dist directory if it doesn't exist
const distDir = path.join(__dirname, '../dist');
if (!fs.existsSync(distDir)) {
    fs.mkdirSync(distDir, { recursive: true });
}

// Output file name with version
const outputFileName = `${pluginName}-v${version}.zip`;
const outputPath = path.join(distDir, outputFileName);

// Create write stream
const output = fs.createWriteStream(outputPath);
const archive = archiver('zip', {
    zlib: { level: 9 } // Maximum compression
});

// Listen for archive events
output.on('close', function() {
    const sizeInMB = (archive.pointer() / 1024 / 1024).toFixed(2);
    console.log('\n✓ ZIP created successfully!');
    console.log(`  File: ${outputFileName}`);
    console.log(`  Size: ${sizeInMB} MB (${archive.pointer()} bytes)`);
    console.log(`  Path: ${outputPath}\n`);
});

archive.on('error', function(err) {
    throw err;
});

archive.on('warning', function(err) {
    if (err.code === 'ENOENT') {
        console.warn('Warning:', err);
    } else {
        throw err;
    }
});

// Pipe archive data to the file
archive.pipe(output);

console.log('\nCreating distribution ZIP...');
console.log(`Version: ${version}\n`);

// Add files to archive
// Use glob patterns to include only necessary files

// Main plugin file
archive.file('cf7-custom-validation-messages.php', { 
    name: `${pluginName}/cf7-custom-validation-messages.php` 
});

// Uninstall file
archive.file('uninstall.php', { 
    name: `${pluginName}/uninstall.php` 
});

// Documentation files (essential only)
const docFiles = [
    'README.md',
    'CHANGELOG.md',
    'readme.txt'  // Required for WordPress.org
];

docFiles.forEach(file => {
    if (fs.existsSync(file)) {
        archive.file(file, { name: `${pluginName}/${file}` });
        console.log(`  ✓ Added: ${file}`);
    }
});

// Add directories
archive.directory('includes/', `${pluginName}/includes`);
archive.directory('admin/', `${pluginName}/admin`);
archive.directory('assets/', `${pluginName}/assets`);

// Finalize the archive
archive.finalize();

