<?php
namespace Schooltrip;

class Teacher extends Person {
    private float $salary;

    public function __construct(string $name, float $salary) {
        parent::__construct($name);
        $this->salary = $salary;
    }

    public function role(): string {
        return "Teacher";
    }

    public function getSalary(): float {
        return $this->salary;
    }
}
