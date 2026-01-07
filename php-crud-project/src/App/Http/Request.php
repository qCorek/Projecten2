<?php
declare(strict_types=1);

namespace App\Http;

final class Request
{
    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server
    ) {}

    public static function fromGlobals(): self
    {
        return new self($_GET, $_POST, $_SERVER);
    }

    public function method(): string
    {
        return strtoupper((string)($this->server['REQUEST_METHOD'] ?? 'GET'));
    }

    public function path(): string
    {
        $uri = (string)($this->server['REQUEST_URI'] ?? '/');
        $path = parse_url($uri, PHP_URL_PATH);
        return $path ?: '/';
    }
}
