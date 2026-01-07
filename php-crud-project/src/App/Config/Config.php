<?php
declare(strict_types=1);

namespace App\Config;

final class Config
{
    /**
     * SQLite database file location.
     * Change to MySQL by updating Connection::createPdo() (see comment there).
     */
    public const SQLITE_PATH = __DIR__ . '/../../../data/app.db';
}
