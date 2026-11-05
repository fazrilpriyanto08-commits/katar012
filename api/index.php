<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    // Ensure writable directories in /tmp for serverless execution
    $tmpDirs = [
        '/tmp/views',
        '/tmp/storage',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/cache'
    ];
    foreach ($tmpDirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
    }

    // Prepare package and services cache in /tmp so Laravel never writes to read-only bootstrap/cache
    $packagesSrc = __DIR__ . '/../bootstrap/cache/packages.php';
    if (!file_exists('/tmp/packages.php') && file_exists($packagesSrc)) {
        copy($packagesSrc, '/tmp/packages.php');
    }

    // Copy pre-seeded SQLite database to /tmp if not present
    $tmpDb = '/tmp/database.sqlite';
    $sourceDb = __DIR__ . '/../database/database.sqlite';
    if (!file_exists($tmpDb) && file_exists($sourceDb)) {
        copy($sourceDb, $tmpDb);
    }

    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "SERVERLESS BOOTSTRAP ERROR:\n";
    echo $e->getMessage() . "\n\n";
    echo $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo $e->getTraceAsString();
}
