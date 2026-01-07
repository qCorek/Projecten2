# Acceptatietest plan – CRUD taken

## Doel
Verifiëren dat de CRUD-functies via de web-UI werken:
- Create: taak toevoegen
- Read: lijst (en edit-form)
- Update: taak wijzigen + status klaar
- Delete: taak verwijderen

## Voorwaarden
- App draait via: `php -S localhost:8000 -t src/public`
- Lege of bestaande SQLite db in `data/app.db` is toegestaan

## Testgevallen
1. **Create**
   - Ga naar `/tasks/create`
   - Vul titel + (optioneel) omschrijving
   - Opslaan → redirect naar `/tasks` en nieuwe taak is zichtbaar

2. **Read**
   - `/tasks` toont alle taken
   - Klik **Wijzig** opent edit-form met huidige waarden

3. **Update**
   - Wijzig titel/omschrijving
   - Zet checkbox **Klaar**
   - Opslaan → waarden zijn aangepast in `/tasks`

4. **Delete**
   - Klik **Verwijder**
   - Bevestig → taak verdwijnt uit lijst
