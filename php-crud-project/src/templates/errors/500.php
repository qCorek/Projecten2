<?php
$title = 'Fout';
ob_start();
?>
<h1>500 - Serverfout</h1>
<p>Er ging iets mis.</p>
<?php if (!empty($message)): ?>
  <pre><?= htmlspecialchars((string)$message) ?></pre>
<?php endif; ?>
<?php
$content = ob_get_clean();
require __DIR__ . '/_layout.php';
