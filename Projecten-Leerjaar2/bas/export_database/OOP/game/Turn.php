<?php

class Turn {
    public $ice;
    public $bears;
    public $penguins;

    public function __construct($i, $b, $p) {
        $this->ice = $i;
        $this->bears = $b;
        $this->penguins = $p;
    }
}
