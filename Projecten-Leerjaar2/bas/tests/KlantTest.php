<?php
use PHPUnit\Framework\TestCase;
use Bas\classes\Klant;

require_once __DIR__ . '/../vendor/autoload.php';

class KlantTest extends TestCase{
    
    protected $klant;

    protected function setUp(): void {
        $this->klant = new Klant();
    }

    public function testGetKlanten(){
        $klanten = $this->klant->getKlanten();
        $this->assertIsArray($klanten);
    }

    public function testInsertKlant(){

        $result = $this->klant->insertKlant(
            "UnitTestNaam",
            "unittest@email.nl",
            "Teststraat 1",
            "1234AB",
            "Rotterdam"
        );

        $this->assertTrue($result);
    }

    public function testGetKlant(){

        $this->klant->insertKlant(
            "TestNaam",
            "test@email.nl",
            "Straat 1",
            "1234AB",
            "Rotterdam"
        );

        $klanten = $this->klant->getKlanten();
        $laatste = end($klanten);

        $klant = $this->klant->getKlant($laatste['klantId']);

        $this->assertEquals($laatste['klantId'], $klant['klantId']);
    }
}