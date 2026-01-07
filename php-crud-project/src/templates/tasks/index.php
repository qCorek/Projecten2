<?php
/** @var \App\Entity\Task[] $tasks */
$title = 'Taken';
ob_start();
?>
<h1>Taken</h1>

<?php if (count($tasks) === 0): ?>
  <p>Geen taken gevonden.</p>
<?php else: ?>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Titel</th>
      <th>Omschrijving</th>
      <th>Status</th>
      <th>Aangemaakt</th>
      <th>Acties</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($tasks as $task): ?>
    <tr>
      <td><?= (int)$task->id() ?></td>
      <td><?= htmlspecialchars($task->title()) ?></td>
      <td><?= htmlspecialchars((string)$task->description()) ?></td>
      <td><?= $task->isDone() ? 'Klaar' : 'Open' ?></td>
      <td><?= htmlspecialchars($task->createdAt()->format('Y-m-d H:i')) ?></td>
      <td class="actions">
        <a class="btn" href="/tasks/<?= (int)$task->id() ?>/edit">Wijzig</a>
        <form method="post" action="/tasks/<?= (int)$task->id() ?>/delete" onsubmit="return confirm('Verwijderen?')">
          <button class="btn" type="submit">Verwijder</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/../_layout.php';
