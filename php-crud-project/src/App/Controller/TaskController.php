<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use App\Http\Request;
use App\Http\Response;
use App\Repository\TaskRepository;
use App\View\ViewRenderer;

final class TaskController
{
    public function __construct(
        private TaskRepository $repo,
        private ViewRenderer $view
    ) {}

    public function index(): Response
    {
        $tasks = $this->repo->findAll();
        $body = $this->view->render('tasks/index', ['tasks' => $tasks]);

        return new Response(200, $body);
    }

    public function createForm(): Response
    {
        $body = $this->view->render('tasks/create', ['errors' => [], 'old' => ['title' => '', 'description' => '']]);
        return new Response(200, $body);
    }

    public function create(Request $request): Response
    {
        $title = trim((string)($request->post['title'] ?? ''));
        $description = trim((string)($request->post['description'] ?? ''));
        $description = $description === '' ? null : $description;

        $errors = [];
        if ($title === '') {
            $errors['title'] = 'Titel is verplicht.';
        }

        if ($errors) {
            $body = $this->view->render('tasks/create', [
                'errors' => $errors,
                'old' => ['title' => $title, 'description' => $description ?? '']
            ]);
            return new Response(422, $body);
        }

        $task = Task::new($title, $description);
        $this->repo->create($task);

        return Response::redirect('/tasks');
    }

    public function editForm(int $id): Response
    {
        $task = $this->repo->findById($id);
        if (!$task) {
            return new Response(404, $this->view->render('errors/404'));
        }

        $body = $this->view->render('tasks/edit', ['task' => $task, 'errors' => []]);
        return new Response(200, $body);
    }

    public function update(int $id, Request $request): Response
    {
        $task = $this->repo->findById($id);
        if (!$task) {
            return new Response(404, $this->view->render('errors/404'));
        }

        $title = trim((string)($request->post['title'] ?? ''));
        $description = trim((string)($request->post['description'] ?? ''));
        $description = $description === '' ? null : $description;
        $isDone = isset($request->post['is_done']) && $request->post['is_done'] === '1';

        $errors = [];
        if ($title === '') {
            $errors['title'] = 'Titel is verplicht.';
        }

        if ($errors) {
            $updated = $task->withTitle($title)->withDescription($description)->markDone($isDone);
            $body = $this->view->render('tasks/edit', ['task' => $updated, 'errors' => $errors]);
            return new Response(422, $body);
        }

        $updated = $task->withTitle($title)->withDescription($description)->markDone($isDone);
        $this->repo->update($updated);

        return Response::redirect('/tasks');
    }

    public function delete(int $id): Response
    {
        $this->repo->delete($id);
        return Response::redirect('/tasks');
    }
}
