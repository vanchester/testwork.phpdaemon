<?php
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';

    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
