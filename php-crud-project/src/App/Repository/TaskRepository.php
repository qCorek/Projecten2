<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Task;
use DateTimeImmutable;
use PDO;

final class TaskRepository
{
    public function __construct(private PDO $pdo) {}

    /**
     * Create DB table if not exists (idempotent).
     */
    public function ensureSchema(): void
    {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT NULL,
    is_done INTEGER NOT NULL DEFAULT 0,
    created_at TEXT NOT NULL
);
SQL;
        $this->pdo->exec($sql);
    }

    public function create(Task $task): Task
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO tasks (title, description, is_done, created_at) VALUES (:title, :description, :is_done, :created_at)'
        );

        $stmt->execute([
            ':title' => $task->title(),
            ':description' => $task->description(),
            ':is_done' => $task->isDone() ? 1 : 0,
            ':created_at' => $task->createdAt()->format(DATE_ATOM),
        ]);

        $id = (int)$this->pdo->lastInsertId();
        return $task->withId($id);
    }

    public function findById(int $id): ?Task
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return $row ? $this->mapRowToTask($row) : null;
    }

    /**
     * @return Task[]
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM tasks ORDER BY id DESC');
        $rows = $stmt->fetchAll();

        return array_map(fn(array $row) => $this->mapRowToTask($row), $rows);
    }

    public function update(Task $task): void
    {
        if ($task->id() === null) {
            throw new \InvalidArgumentException('Cannot update a Task without id.');
        }

        $stmt = $this->pdo->prepare(
            'UPDATE tasks SET title = :title, description = :description, is_done = :is_done WHERE id = :id'
        );

        $stmt->execute([
            ':title' => $task->title(),
            ':description' => $task->description(),
            ':is_done' => $task->isDone() ? 1 : 0,
            ':id' => $task->id(),
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    private function mapRowToTask(array $row): Task
    {
        return new Task(
            (int)$row['id'],
            (string)$row['title'],
            $row['description'] !== null ? (string)$row['description'] : null,
            ((int)$row['is_done']) === 1,
            new DateTimeImmutable((string)$row['created_at'])
        );
    }
}
