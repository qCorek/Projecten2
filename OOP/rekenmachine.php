<?php

use PHPUnit\Framework\TestCase;

/* =====================
   REKENMACHINE CLASS
===================== */

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

    public function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    public function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    public function divide(float $a, float $b): float
    {
        if ($b == 0) {
            throw new Exception("Delen door nul is niet mogelijk!");
        }

        return $a / $b;
    }
}

/* =====================
   TESTS
===================== */

class CalculatorTest extends TestCase
{
    /* -------- SUBTRACT -------- */

    public function testSubtractPositiveNumbers()
    {
        $calc = new Rekenmachine();
        $this->assertEquals(5, $calc->subtract(10, 5));
    }

    public function testSubtractNegativeResult()
    {
        $calc = new Rekenmachine();
        $this->assertEquals(-5, $calc->subtract(5, 10));
    }

    public function testSubtractWithZero()
    {
        $calc = new Rekenmachine();
        $this->assertEquals(10, $calc->subtract(10, 0));
    }

    /* -------- MULTIPLY -------- */

    public function testMultiplyPositiveNumbers()
    {
        $calc = new Rekenmachine();
        $this->assertEquals(20, $calc->multiply(4, 5));
    }

    public function testMultiplyWithZero()
    {
        $calc = new Rekenmachine();
        $this->assertEquals(0, $calc->multiply(10, 0));
    }

    public function testMultiplyNegativeNumbers()
    {
        $calc = new Rekenmachine();
        $this->assertEquals(-15, $calc->multiply(-3, 5));
    }

    /* -------- DIVIDE -------- */

    public function testDivideNormal()
    {
        $calc = new Rekenmachine();
        $this->assertEquals(5, $calc->divide(10, 2));
    }

    public function testDivideDecimalResult()
    {
        $calc = new Rekenmachine();
        $this->assertEquals(2.5, $calc->divide(5, 2));
    }

    public function testDivideByZeroThrowsException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Delen door nul is niet mogelijk!");

        $calc = new Rekenmachine();
        $calc->divide(10, 0);
    }
}
