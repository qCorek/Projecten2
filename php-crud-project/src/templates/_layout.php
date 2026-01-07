<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'CRUD') ?></title>
  <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 2rem; }
    header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ddd; padding: .6rem; vertical-align: top; }
    th { text-align: left; }
    a, button { cursor: pointer; }
    .error { color: #b00020; font-size: .9rem; }
    .actions form { display: inline; }
    input[type="text"], textarea { width: 100%; padding: .5rem; }
    .row { margin-bottom: 1rem; }
    .btn { padding: .5rem .8rem; border: 1px solid #333; background: #fff; }
  </style>
</head>
<body>
<header>
  <div><strong>Tasks CRUD</strong></div>
  <nav>
    <a href="/tasks">Overzicht</a> |
    <a href="/tasks/create">Nieuw</a>
  </nav>
</header>

<?= $content ?? '' ?>

</body>
</html>
