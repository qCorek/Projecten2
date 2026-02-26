<?php
namespace Schooltrip;

class Student extends Person {
    private Group $className;
    private bool $paid;

    public function __construct(string $name, Group $className, bool $paid) {
        parent::__construct($name);
        $this->className = $className;
        $this->paid = $paid;
    }

    public function role(): string {
        return "Student";
    }

    public function getClassName(): Group {
        return $this->className;
    }

    public function hasPaid(): bool {
        return $this->paid;
    }
}
