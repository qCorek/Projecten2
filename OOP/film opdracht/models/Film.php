<?php
class Film
{
    private ?int $id;
    private string $filmnaam;
    private string $genre;

    public function __construct(?int $id, string $filmnaam, string $genre)
    {
        $this->id = $id;
        $this->filmnaam = $filmnaam;
        $this->genre = $genre;
    }

    public function getId(): ?int     { return $this->id; }
    public function getFilmnaam(): string { return $this->filmnaam; }
    public function getGenre(): string    { return $this->genre; }

    public function setFilmnaam(string $filmnaam): void { $this->filmnaam = $filmnaam; }
    public function setGenre(string $genre): void       { $this->genre = $genre; }
}
