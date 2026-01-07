<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Entity\Task;
use App\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;
use Tests\Support\PdoFactory;

final class TaskRepositoryTest extends TestCase
{
    private TaskRepository $repo;

    protected function setUp(): void
    {
        $pdo = PdoFactory::sqliteMemory();
        $this->repo = new TaskRepository($pdo);
        $this->repo->ensureSchema();
    }

    public function testCreatePersistsAndReturnsId(): void
    {
        $created = $this->repo->create(Task::new('Titel', 'Omschrijving'));

        $this->assertNotNull($created->id());

        $found = $this->repo->findById((int)$created->id());
        $this->assertNotNull($found);
        $this->assertSame('Titel', $found->title());
    }

    public function testFindAllReturnsDescendingById(): void
    {
        $t1 = $this->repo->create(Task::new('A'));
        $t2 = $this->repo->create(Task::new('B'));

        $all = $this->repo->findAll();
        $this->assertCount(2, $all);
        $this->assertSame($t2->id(), $all[0]->id());
        $this->assertSame($t1->id(), $all[1]->id());
    }

    public function testUpdateChangesFields(): void
    {
        $t = $this->repo->create(Task::new('A', null));
        $updated = $t->withTitle('A2')->withDescription('D')->markDone(true);

        $this->repo->update($updated);

        $found = $this->repo->findById((int)$t->id());
        $this->assertNotNull($found);
        $this->assertSame('A2', $found->title());
        $this->assertSame('D', $found->description());
        $this->assertTrue($found->isDone());
    }

    public function testDeleteRemovesRow(): void
    {
        $t = $this->repo->create(Task::new('A'));
        $this->repo->delete((int)$t->id());

        $this->assertNull($this->repo->findById((int)$t->id()));
        $this->assertSame([], $this->repo->findAll());
    }

    public function testUpdateWithoutIdThrows(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->repo->update(Task::new('No id'));
    }
}
