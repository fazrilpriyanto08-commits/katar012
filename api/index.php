<?php

// Direct static file delivery for serverless environments
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
$publicFile = __DIR__ . '/../public' . $uri;

if ($uri !== '/' && !empty($uri) && file_exists($publicFile) && is_file($publicFile)) {
    $ext = strtolower(pathinfo($publicFile, PATHINFO_EXTENSION));
    $mimes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
    ];
    $contentType = $mimes[$ext] ?? 'application/octet-stream';
    header('Content-Type: ' . $contentType);
    header('Cache-Control: public, max-age=86400');
    header('Content-Length: ' . filesize($publicFile));
    readfile($publicFile);
    exit;
}

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
