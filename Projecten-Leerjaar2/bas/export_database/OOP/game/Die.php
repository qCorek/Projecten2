<?php

class DieFace {
    public $value;
    public $ice = 0;
    public $bears = 0;
    public $penguins = 0;

    public function __construct() {
        $this->value = rand(1, 6);

        if (in_array($this->value, [1, 3, 5])) {
            $this->ice = 1;
            $this->bears = ($this->value - 1) * 2;
            $this->penguins = 7 - $this->value;
        }
    }
}
