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

    // Prepare package and services cache in /tmp
    $packagesSrc = __DIR__ . '/../bootstrap/cache/packages.php';
    if (file_exists($packagesSrc)) {
        copy($packagesSrc, '/tmp/packages.php');
    }

    $servicesSrc = __DIR__ . '/../bootstrap/cache/services.php';
    if (file_exists($servicesSrc)) {
        copy($servicesSrc, '/tmp/services.php');
    }

    // Copy clean SQLite database to /tmp if not present or updated
    $tmpDb = '/tmp/database.sqlite';
    $sourceDb = __DIR__ . '/../database/database.sqlite';
    if (file_exists($sourceDb)) {
        if (!file_exists($tmpDb) || filemtime($sourceDb) > filemtime($tmpDb)) {
            copy($sourceDb, $tmpDb);
        }
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
