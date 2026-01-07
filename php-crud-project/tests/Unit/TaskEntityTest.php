<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Entity\Task;
use PHPUnit\Framework\TestCase;

final class TaskEntityTest extends TestCase
{
    public function testNewTaskHasNoIdAndIsNotDone(): void
    {
        $task = Task::new('Test', 'Omschrijving');

        $this->assertNull($task->id());
        $this->assertSame('Test', $task->title());
        $this->assertSame('Omschrijving', $task->description());
        $this->assertFalse($task->isDone());
        $this->assertNotEmpty($task->createdAt()->format(DATE_ATOM));
    }

    public function testWithersReturnNewInstance(): void
    {
        $task = Task::new('A');

        $task2 = $task->withTitle('B');
        $this->assertSame('A', $task->title());
        $this->assertSame('B', $task2->title());

        $task3 = $task2->withDescription('X')->markDone(true);
        $this->assertSame('X', $task3->description());
        $this->assertTrue($task3->isDone());
    }
}
