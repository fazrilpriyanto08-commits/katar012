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

    // Map Neon / Vercel Postgres connection URL to Laravel DB_URL
    // Prefer pooled URL for fast connection reuse on serverless requests
    $pgUrl = getenv('DATABASE_URL')
        ?: ($_ENV['DATABASE_URL']
        ?? (getenv('POSTGRES_URL')
        ?: ($_ENV['POSTGRES_URL']
        ?? (getenv('DATABASE_URL_UNPOOLED')
        ?: ($_ENV['DATABASE_URL_UNPOOLED'] ?? null)))));

    if ($pgUrl) {
        putenv('DB_CONNECTION=pgsql');
        putenv('DB_URL=' . $pgUrl);
        putenv('DB_SSLMODE=require');
        $_ENV['DB_CONNECTION'] = 'pgsql';
        $_ENV['DB_URL'] = $pgUrl;
        $_ENV['DB_SSLMODE'] = 'require';
        $_SERVER['DB_CONNECTION'] = 'pgsql';
        $_SERVER['DB_URL'] = $pgUrl;
        $_SERVER['DB_SSLMODE'] = 'require';
    } else {
        // Fallback to SQLite in /tmp if no cloud database URL is configured
        $tmpDb = '/tmp/database.sqlite';
        $sourceDb = __DIR__ . '/../database/database.sqlite';
        if (file_exists($sourceDb) && (!file_exists($tmpDb) || filemtime($sourceDb) > filemtime($tmpDb))) {
            copy($sourceDb, $tmpDb);
        }
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_DATABASE=' . $tmpDb);
        $_ENV['DB_CONNECTION'] = 'sqlite';
        $_ENV['DB_DATABASE'] = $tmpDb;
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
