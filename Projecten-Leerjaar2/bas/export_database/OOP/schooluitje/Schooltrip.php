<?php
namespace Schooltrip;

class Schooltrip {
    private string $name;
    private array $schooltripLists = [];
    private static int $totalAmount = 0;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function addSchooltripList(SchooltripList $list): void {
        $this->schooltripLists[] = $list;
    }

    public function getSchooltripLists(): array {
        return $this->schooltripLists;
    }

    public static function addToTotalAmount(int $amount): void {
        self::$totalAmount += $amount;
    }

    public static function getTotalAmount(): int {
        return self::$totalAmount;
    }

    public function getName(): string {
        return $this->name;
    }
}
