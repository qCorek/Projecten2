<?php

namespace CrudFietsen;

use PDO;
use PDOException;

class Database
{
    public function connectDb()
    {
        $servername = SERVERNAME;
        $username = USERNAME;
        $password = PASSWORD;
        $dbname = DATABASE;

        try {
            $conn = new PDO(
                "mysql:host=$servername;dbname=$dbname",
                $username,
                $password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
