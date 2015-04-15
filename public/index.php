<?php

require __DIR__ . '/../autoloader.php';

$dataKey = null;
$eol = null;

if (php_sapi_name() === 'cli') {
    $eol = PHP_EOL;
    if (!empty($argv[1])) {
        $dataKey = $argv[1];
    }
} else {
    if (!empty($_SERVER['REQUEST_URI'])) {
        $dataKey = trim($_SERVER['REQUEST_URI'], '/');
    }
}

if (empty($dataKey)) {
    exit("[ERR] Data key required" . $eol);
}

echo Service\Client::init(include(__DIR__ . '/../config.php'))->read($dataKey) . $eol;
