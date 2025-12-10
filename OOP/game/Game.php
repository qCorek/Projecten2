<?php

class Game {
    public $dice = [];
    public $wrong = 0;
    public $finished = false;

    private $ice = 0;
    private $bears = 0;
    private $penguins = 0;

    public function __construct($amount) {
        for ($i = 0; $i < $amount; $i++) {
            $die = new DieFace();
            $this->dice[] = $die;

            $this->ice += $die->ice;
            $this->bears += $die->bears;
            $this->penguins += $die->penguins;
        }
    }

    public function guess(Turn $turn) {
        if ($turn->ice == $this->ice &&
            $turn->bears == $this->bears &&
            $turn->penguins == $this->penguins) {

            $this->finished = true;
            return "Goed geraden!";
        }

        $this->wrong++;
        if ($this->wrong == 3) {
            return "Fout. Hint: ijsberen zitten alleen bij een wak.";
        }

        return "Fout geraden.";
    }

    public function getAnswer() {
        return [
            "ice" => $this->ice,
            "bears" => $this->bears,
            "penguins" => $this->penguins
        ];
    }
}
