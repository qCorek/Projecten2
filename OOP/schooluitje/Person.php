<?php
namespace Schooltrip;

abstract class Person {
    private string $name;
    private string $role;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getRole(): string {
        return $this->role;
    }

    abstract public function role(): string;
}
