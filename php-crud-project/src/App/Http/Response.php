<?php
declare(strict_types=1);

namespace App\Http;

final class Response
{
    public function __construct(
        public readonly int $status,
        public readonly string $body,
        public readonly array $headers = ['Content-Type' => 'text/html; charset=utf-8']
    ) {}

    public function send(): void
    {
        http_response_code($this->status);
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
        echo $this->body;
    }

    public static function redirect(string $to): self
    {
        return new self(302, '', ['Location' => $to]);
    }
}
