<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

use App\Controller\TaskController;
use App\Database\Connection;
use App\Http\Request;
use App\Http\Response;
use App\Repository\TaskRepository;
use App\View\ViewRenderer;

$request = Request::fromGlobals();

$pdo = Connection::pdo();
$repo = new TaskRepository($pdo);
$repo->ensureSchema();

$view = new ViewRenderer(__DIR__ . '/../templates');
$controller = new TaskController($repo, $view);

$method = $request->method();
$path = $request->path();

// Very small router
try {
    if ($path === '/' || $path === '/tasks') {
        $response = $controller->index();
    } elseif ($path === '/tasks/create' && $method === 'GET') {
        $response = $controller->createForm();
    } elseif ($path === '/tasks/create' && $method === 'POST') {
        $response = $controller->create($request);
    } elseif (preg_match('#^/tasks/(\d+)/edit$#', $path, $m) && $method === 'GET') {
        $response = $controller->editForm((int)$m[1]);
    } elseif (preg_match('#^/tasks/(\d+)/edit$#', $path, $m) && $method === 'POST') {
        $response = $controller->update((int)$m[1], $request);
    } elseif (preg_match('#^/tasks/(\d+)/delete$#', $path, $m) && $method === 'POST') {
        $response = $controller->delete((int)$m[1]);
    } else {
        $response = new Response(404, $view->render('errors/404'));
    }
} catch (Throwable $e) {
    $response = new Response(500, $view->render('errors/500', ['message' => $e->getMessage()]));
}

$response->send();
