<?php
declare(strict_types=1);

require __DIR__ . '/../src/autoload.php';

// (optioneel) extra autoload voor tests
spl_autoload_register(function (string $class): void {
    $prefix = 'Tests\\';
    $baseDir = __DIR__ . '/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relative) . '.php';

    if (is_file($file)) {
        require $file;
    }
});
