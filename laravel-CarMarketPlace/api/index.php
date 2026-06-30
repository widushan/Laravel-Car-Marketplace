<?php

// On Vercel, the filesystem is read-only except for /tmp
// We need to make sure required writable directories exist in /tmp

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

// TEMPORARY: Catch and display the REAL error
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => array_slice(explode("\n", $e->getTraceAsString()), 0, 15),
    ], JSON_PRETTY_PRINT);
    exit(1);
}
