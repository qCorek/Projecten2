<?php
// Game.php - beheert het dobbelspel
require_once 'Dice.php';

class Game {
    const NUMBER_OF_DICE = 5;
    const MAX_THROWS = 3;

    private $dice = [];
    private $throwCount;
    private $lastThrow = [];

    public function __construct() {
        $this->throwCount = 0;
        // Maak 5 dobbelstenen
        for ($i = 0; $i < self::NUMBER_OF_DICE; $i++) {
            $this->dice[$i] = new Dice();
        }
    }

    // Mag er nog gegooid worden?
    public function canThrow() {
        return $this->throwCount < self::MAX_THROWS;
    }

    // Gooi alle dobbelstenen
    public function throwAllDice() {
        if (!$this->canThrow()) {
            return;
        }

        $this->throwCount++;

        $values = [];
        foreach ($this->dice as $die) {
            $die->throwDice();
            $values[] = $die->getFaceValue();
        }
        $this->lastThrow = $values;
    }

    public function getThrowCount() {
        return $this->throwCount;
    }

    public function getLastThrow() {
        return $this->lastThrow;
    }

    public function isFinished() {
        return !$this->canThrow();
    }

    // EXTRA: controleer of alle dobbelstenen hetzelfde aantal ogen hebben
    public function allDiceEqual() {
        if (empty($this->lastThrow)) {
            return false;
        }
        return count(array_unique($this->lastThrow)) === 1;
    }

    // EXTRA: maak simpele SVG voor een dobbelsteen
    public function generateSvgForValue($value, $color = 'white') {
        $svg = "<svg width='60' height='60' viewBox='0 0 100 100' ".
               "xmlns='http://www.w3.org/2000/svg' style='margin:5px; border: 1px solid #000;'>";
        $svg .= "<rect width='100' height='100' style='fill: {$color};'/>";

        $ogenPosities = [
            1 => [[50, 50]],
            2 => [[30, 30], [70, 70]],
            3 => [[30, 30], [50, 50], [70, 70]],
            4 => [[30, 30], [30, 70], [70, 30], [70, 70]],
            5 => [[30, 30], [30, 70], [50, 50], [70, 30], [70, 70]],
            6 => [[30, 30], [30, 50], [30, 70], [70, 30], [70, 50], [70, 70]],
        ];

        foreach ($ogenPosities[$value] as $positie) {
            $svg .= "<circle cx='{$positie[0]}' cy='{$positie[1]}' r='8' fill='black'/>";
        }

        $svg .= "</svg>";
        return $svg;
    }
}
