<?php
namespace Hospital;

class Nurse extends Staff {
    public function __construct(string $name) {
        parent::__construct($name, "Nurse");
    }

    public function setSalary(float $amount): void {
        $this->salary = $amount;
    }

    public function getRoleDescription(): string {
        return "Nurse assists doctor and supports patient care.";
    }
}
