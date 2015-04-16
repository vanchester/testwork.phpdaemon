<?php

require __DIR__ . '/../autoloader.php';

$dataKey = null;
$eol = null;

if (php_sapi_name() === 'cli') {
    $eol = PHP_EOL;
    $dataKey = isset($argv[1]) ? $argv[1] : null;
} else {
    $dataKey = isset($_SERVER['REQUEST_URI']) ? trim($_SERVER['REQUEST_URI'], '/') : null;
}

if ($dataKey == '') {
    exit("[ERR] Data key required" . $eol);
}

echo Service\Client::init(include(__DIR__ . '/../config.php'))->read($dataKey) . $eol;
