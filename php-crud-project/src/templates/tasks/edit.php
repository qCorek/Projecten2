<?php
/** @var \App\Entity\Task $task */
$title = 'Taak wijzigen';
ob_start();
?>
<h1>Taak wijzigen</h1>

<form method="post" action="/tasks/<?= (int)$task->id() ?>/edit">
  <div class="row">
    <label for="title">Titel *</label><br>
    <input id="title" name="title" type="text" value="<?= htmlspecialchars($task->title()) ?>">
    <?php if (!empty($errors['title'])): ?><div class="error"><?= htmlspecialchars($errors['title']) ?></div><?php endif; ?>
  </div>

  <div class="row">
    <label for="description">Omschrijving</label><br>
    <textarea id="description" name="description" rows="4"><?= htmlspecialchars((string)$task->description()) ?></textarea>
  </div>

  <div class="row">
    <label>
      <input type="checkbox" name="is_done" value="1" <?= $task->isDone() ? 'checked' : '' ?>>
      Klaar
    </label>
  </div>

  <button class="btn" type="submit">Opslaan</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../_layout.php';
