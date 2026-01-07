<?php
declare(strict_types=1);

namespace App\View;

final class ViewRenderer
{
    public function __construct(private string $templatesPath) {}

    public function render(string $template, array $data = []): string
    {
        $file = rtrim($this->templatesPath, '/\\') . DIRECTORY_SEPARATOR . $template . '.php';

        if (!is_file($file)) {
            throw new \RuntimeException("Template not found: {$file}");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $file;
        return (string)ob_get_clean();
    }
}
