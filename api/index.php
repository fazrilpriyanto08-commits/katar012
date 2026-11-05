<?php

// Ensure writable directories in /tmp for serverless execution
$tmpDirs = ['/tmp/views', '/tmp/storage', '/tmp/storage/framework/views', '/tmp/storage/framework/sessions', '/tmp/storage/framework/cache'];
foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy pre-seeded SQLite database to /tmp if not present
$tmpDb = '/tmp/database.sqlite';
$sourceDb = __DIR__ . '/../database/database.sqlite';
if (!file_exists($tmpDb) && file_exists($sourceDb)) {
    copy($sourceDb, $tmpDb);
}

require __DIR__ . '/../public/index.php';
