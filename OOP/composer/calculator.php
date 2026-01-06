<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

/* =====================
   REKENMACHINE CLASS
===================== */

/**
 * Rekenmachine voor basisberekeningen
 */
class Rekenmachine
{
    private float $waarde;

    public function __construct(float $waarde = 0.0)
    {
        $this->waarde = $waarde;
    }

    /**
     * Tel een getal op bij de huidige waarde
     */
    public function telOp(float $getal): float
    {
        $this->waarde += $getal;

        return $this->waarde;
    }

    /**
     * Trek twee getallen van elkaar af
     */
    public function trekAf(float $a, float $b): float
    {
        return $a - $b;
    }

    /**
     * Vermenigvuldig twee getallen
     */
    public function vermenigvuldig(float $a, float $b): float
    {
        return $a * $b;
    }

    /**
     * Deel twee getallen
     *
     * @throws InvalidArgumentException
     */
    public function deel(float $a, float $b): float
    {
        if ($b === 0.0) {
            throw new InvalidArgumentException('Delen door nul is niet mogelijk!');
        }

        return $a / $b;
    }
}

/* =====================
   TESTS
===================== */

class CalculatorTest extends TestCase
{
    /* -------- TREK AF -------- */

    public function testSubtractPositiveNumbers(): void
    {
        $calc = new Rekenmachine();
        $this->assertEquals(5, $calc->trekAf(10, 5));
    }

    public function testSubtractNegativeResult(): void
    {
        $calc = new Rekenmachine();
        $this->assertEquals(-5, $calc->trekAf(5, 10));
    }

    public function testSubtractWithZero(): void
    {
        $calc = new Rekenmachine();
        $this->assertEquals(10, $calc->trekAf(10, 0));
    }

    /* -------- VERMENIGVULDIG -------- */

    public function testMultiplyPositiveNumbers(): void
    {
        $calc = new Rekenmachine();
        $this->assertEquals(20, $calc->vermenigvuldig(4, 5));
    }

    public function testMultiplyWithZero(): void
    {
        $calc = new Rekenmachine();
        $this->assertEquals(0, $calc->vermenigvuldig(10, 0));
    }

    public function testMultiplyNegativeNumbers(): void
    {
        $calc = new Rekenmachine();
        $this->assertEquals(-15, $calc->vermenigvuldig(-3, 5));
    }

    /* -------- DEEL -------- */

    public function testDivideNormal(): void
    {
        $calc = new Rekenmachine();
        $this->assertEquals(5, $calc->deel(10, 2));
    }

    public function testDivideDecimalResult(): void
    {
        $calc = new Rekenmachine();
        $this->assertEquals(2.5, $calc->deel(5, 2));
    }

    public function testDivideByZeroThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Delen door nul is niet mogelijk!');

        $calc = new Rekenmachine();
        $calc->deel(10, 0);
    }
}
