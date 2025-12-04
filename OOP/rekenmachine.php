<?php

class Rekenmachine
{
    public float $waarde;

    public function __construct(float $waarde = 0)
    {
        $this->waarde = $waarde;
    }

    public function telOp(float $getal): float
    {
        $this->waarde += $getal;
        return $this->waarde;
    }
}



?>