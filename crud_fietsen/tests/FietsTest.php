<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/functions.php';

use PHPUnit\Framework\TestCase;

class FietsTest extends TestCase
{
    private Fiets $fiets;

    protected function setUp(): void
    {
        $this->fiets = new Fiets();
    }

    public function testInsertRecord()
    {
        $data = [
            'merk' => 'Gazelle',
            'type' => 'Stadsfiets',
            'prijs' => 599
        ];

        $this->assertTrue($this->fiets->insertRecord($data));
    }

    public function testGetData()
    {
        $result = $this->fiets->getData(CRUD_TABLE);
        $this->assertIsArray($result);
    }

    public function testUpdateRecord()
    {
        $this->fiets->insertRecord([
            'merk' => 'Batavus',
            'type' => 'Test',
            'prijs' => 100
        ]);

        $data = [
            'id' => 1,
            'merk' => 'Batavus',
            'type' => 'Elektrisch',
            'prijs' => 1200
        ];

        $result = $this->fiets->updateRecord($data);
        $this->assertIsBool($result);
    }

    public function testDeleteRecord()
    {
        $this->fiets->insertRecord([
            'merk' => 'Sparta',
            'type' => 'Test',
            'prijs' => 200
        ]);

        $result = $this->fiets->deleteRecord(1);
        $this->assertIsBool($result);
    }
}
