<?php
$title = 'Niet gevonden';
ob_start();
?>
<h1>404 - Niet gevonden</h1>
<p>De pagina bestaat niet.</p>
<?php
$content = ob_get_clean();
require __DIR__ . '/_layout.php';
