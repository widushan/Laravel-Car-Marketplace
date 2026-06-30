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

// Override storage and bootstrap cache paths before Laravel boots
$_ENV['APP_STORAGE_PATH'] = '/tmp/storage';
$_SERVER['APP_STORAGE_PATH'] = '/tmp/storage';

// Forward all Vercel requests to Laravel's public/index.php
require __DIR__ . '/../public/index.php';
