<?php
// Dice.php - stelt één dobbelsteen voor
class Dice {
    const NUMBER_OF_SIDES = 6;

    private $faceValue;

    public function __construct() {
        // Begin met waarde 1
        $this->faceValue = 1;
    }

    // Gooi de dobbelsteen (krijg een willekeurig getal van 1 t/m 6)
    public function throwDice() {
        $this->faceValue = rand(1, self::NUMBER_OF_SIDES);
    }

    public function getFaceValue() {
        return $this->faceValue;
    }
}
