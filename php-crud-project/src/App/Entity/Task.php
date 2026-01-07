<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;

final class Task
{
    public function __construct(
        private ?int $id,
        private string $title,
        private ?string $description,
        private bool $isDone,
        private DateTimeImmutable $createdAt
    ) {}

    public static function new(string $title, ?string $description = null): self
    {
        return new self(
            null,
            $title,
            $description,
            false,
            new DateTimeImmutable('now')
        );
    }

    public function id(): ?int { return $this->id; }
    public function title(): string { return $this->title; }
    public function description(): ?string { return $this->description; }
    public function isDone(): bool { return $this->isDone; }
    public function createdAt(): DateTimeImmutable { return $this->createdAt; }

    public function withId(int $id): self
    {
        return new self($id, $this->title, $this->description, $this->isDone, $this->createdAt);
    }

    public function withTitle(string $title): self
    {
        return new self($this->id, $title, $this->description, $this->isDone, $this->createdAt);
    }

    public function withDescription(?string $description): self
    {
        return new self($this->id, $this->title, $description, $this->isDone, $this->createdAt);
    }

    public function markDone(bool $done = true): self
    {
        return new self($this->id, $this->title, $this->description, $done, $this->createdAt);
    }
}
