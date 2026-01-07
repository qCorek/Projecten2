# PHP CRUD (Tasks) – met autoloading, namespacing en PDO

## Structuur
- `src/` – applicatiecode (PSR-4 autoloading)
- `ontwerp/` – classdiagram + DB schema + acceptatietestverslag
- `tests/` – PHPUnit unit tests + acceptatietest (script + verslag)
- `data/` – SQLite databasebestand (lokaal)

## Starten (lokale PHP server)
```bash
php -S localhost:8000 -t src/public
```
Open daarna: `http://localhost:8000/tasks`

## Database
Standaard gebruikt dit project SQLite: `data/app.db` (wordt automatisch aangemaakt).
Schema staat ook in `ontwerp/schema.sql`.

## Autoloading & namespacing
- Autoloader: `src/autoload.php`
- Namespace prefix: `App\`
- Klassen staan onder `src/App/...` (1 class per bestand)

## Tests
De unit tests zijn geschreven voor PHPUnit.

1) Installeer PHPUnit (bijv. via Composer of phpunit.phar)
2) Run:
```bash
phpunit
```
