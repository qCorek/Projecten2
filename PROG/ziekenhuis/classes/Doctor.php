<?php
namespace Hospital;

class Doctor extends Staff {
    public function __construct(string $name) {
        parent::__construct($name, "Doctor");
    }

    public function setSalary(float $amount): void {
        $this->salary = $amount;
    }

    public function getRoleDescription(): string {
        return "Doctor responsible for patient treatment.";
    }
}
