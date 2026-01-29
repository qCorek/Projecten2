<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use CrudFietsen\Database;
use PDO;

class DatabaseTest extends TestCase
{
    public function testConnectDbReturnsPDO()
    {
        // Test-constants (zoals in je echte project)
        if (!defined('SERVERNAME')) {
            define('SERVERNAME', 'localhost');
            define('USERNAME', 'root');
            define('PASSWORD', '');
            define('DATABASE', 'testdb');
        }

        $database = new Database();
        $conn = $database->connectDb();

        $this->assertInstanceOf(PDO::class, $conn);
    }
}
