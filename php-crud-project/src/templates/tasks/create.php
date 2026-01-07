<?php
$title = 'Taak toevoegen';
ob_start();
?>
<h1>Taak toevoegen</h1>

<form method="post" action="/tasks/create">
  <div class="row">
    <label for="title">Titel *</label><br>
    <input id="title" name="title" type="text" value="<?= htmlspecialchars((string)($old['title'] ?? '')) ?>">
    <?php if (!empty($errors['title'])): ?><div class="error"><?= htmlspecialchars($errors['title']) ?></div><?php endif; ?>
  </div>

  <div class="row">
    <label for="description">Omschrijving</label><br>
    <textarea id="description" name="description" rows="4"><?= htmlspecialchars((string)($old['description'] ?? '')) ?></textarea>
  </div>

  <button class="btn" type="submit">Opslaan</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../_layout.php';
