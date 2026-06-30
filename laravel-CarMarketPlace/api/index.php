<?php

// TEMPORARY DEBUG: Force errors to display
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Catch fatal errors and uncaught exceptions before Laravel
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        header('Content-Type: application/json');
        echo json_encode($error, JSON_PRETTY_PRINT);
    }
});

set_exception_handler(function ($e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'previous' => $e->getPrevious() ? $e->getPrevious()->getMessage() : null,
        'trace' => array_slice(explode("\n", $e->getTraceAsString()), 0, 20),
    ], JSON_PRETTY_PRINT);
    exit(1);
});

// On Vercel, the filesystem is read-only except for /tmp
$tmpDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Write the Aiven MySQL CA certificate to /tmp so PDO can use it
$caCertContent = getenv('MYSQL_SSL_CA_CERT');
if ($caCertContent) {
    $caCertPath = '/tmp/ca.pem';
    file_put_contents($caCertPath, $caCertContent);
    $_ENV['MYSQL_ATTR_SSL_CA'] = $caCertPath;
    $_SERVER['MYSQL_ATTR_SSL_CA'] = $caCertPath;
    putenv("MYSQL_ATTR_SSL_CA=$caCertPath");
}

// Override storage path before Laravel boots
$_ENV['APP_STORAGE_PATH'] = '/tmp/storage';
$_SERVER['APP_STORAGE_PATH'] = '/tmp/storage';

// Force debug mode temporarily to see real errors
$_ENV['APP_DEBUG'] = 'true';
$_SERVER['APP_DEBUG'] = 'true';
putenv('APP_DEBUG=true');

// Forward all Vercel requests to Laravel's public/index.php
require __DIR__ . '/../public/index.php';
