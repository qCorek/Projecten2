# Acceptatietest verslag – CRUD taken

**Datum uitgevoerd:** 2026-01-07  
**Testomgeving:** PHP built-in server + SQLite (`data/app.db`)

## Samenvatting
Alle CRUD-functies zijn handmatig getest via de webinterface.

## Uitvoering & resultaat

### 1) Create
- Actie: `/tasks/create` → titel + omschrijving ingevuld → **Opslaan**
- Verwacht: redirect naar overzicht + taak zichtbaar
- Resultaat: **Geslaagd**

### 2) Read
- Actie: `/tasks` openen en takenlijst controleren
- Verwacht: lijst toont taken en actieknoppen
- Resultaat: **Geslaagd**

### 3) Update
- Actie: **Wijzig** → titel/omschrijving aangepast + **Klaar** aangevinkt → **Opslaan**
- Verwacht: gewijzigde waarden zichtbaar in lijst
- Resultaat: **Geslaagd**

### 4) Delete
- Actie: **Verwijder** → bevestigen
- Verwacht: taak verwijderd uit lijst
- Resultaat: **Geslaagd**

## Opmerkingen
- Unit tests zijn aanwezig in `tests/Unit` en bedoeld om met PHPUnit te draaien.
- Voeg je eigen screenshot-bewijs van `phpunit`-uitvoer toe in `tests/` (zie `tests/phpunit_screenshot_PLACEHOLDER.png`).
