<?php
class Acteur
{
    private ?int $id;
    private string $acteurnaam;

    public function __construct(?int $id, string $acteurnaam)
    {
        $this->id = $id;
        $this->acteurnaam = $acteurnaam;
    }

    public function getId(): ?int            { return $this->id; }
    public function getActeurnaam(): string  { return $this->acteurnaam; }

    public function setActeurnaam(string $naam): void { $this->acteurnaam = $naam; }
}
