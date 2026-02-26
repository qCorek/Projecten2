<?php
namespace Hospital;

abstract class Staff extends Person {
    protected float $salary = 0.0;

    public function __construct(string $name, string $role) {
        parent::__construct($name, $role);
    }

    abstract public function setSalary(float $amount): void;

    public function getSalary(): float {
        return $this->salary;
    }
}
