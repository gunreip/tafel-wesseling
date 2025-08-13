# Tafel Wesseling – Tageszusammenfassung 2025-08-13

## 1. CipherSweet / Blind Index Fixes
- **Service Provider**: Korrekt in `/bootstrap/app.php` registriert →  
  `Spatie\LaravelCipherSweet\LaravelCipherSweetServiceProvider::class`
- **UUID-Unterstützung**: Tabellen `customers` und `blind_indexes` auf UUID umgestellt.
- **Blind Index Constraints**: Unique Constraint auf (`indexable_type`, `indexable_id`, `name`) ergänzt → Fix für `ON CONFLICT` Fehler.
- **Key-Datei**:
  - Pfad `.env` → `CIPHERSWEET_PROVIDER=file` + `CIPHERSWEET_FILE_PATH=/home/gunreip/.config/tafel-wesseling/ciphersweet.key`
  - Rechte für `www-data` korrigiert (ACL + chmod + chown)
- **Insert / Query**: Testdaten erfolgreich erstellt, Suche via `whereBlind()` läuft.

## 2. Fehlerbehebung 500er im Browser
- Problem: PHP-FPM (`www-data`) konnte Key-Datei nicht lesen.
- Lösung: Besitzer- und ACL-Anpassungen, PHP-FPM + nginx reload, Cache Clear mit `php artisan optimize:clear`.

## 3. Logging-Tools
- Neues Skript `save-logs` → sammelt Nginx/PHP/Laravel-Logs projektspezifisch in `./.tails/save-logs/`.
- Neues Skript `save-request` → speichert Request/Response-Infos in `./.tails/save-request/`.
- Beide mit **max. N Dateien** pro Unterordner (ältere werden gelöscht).

## 4. PostgreSQL-Backup-Tools
- **pgdump**:
  - Zentrale Installation (`~/bin/pgdump`)
  - Speichert Dumps nach `./.tails/backup/backup_<db>_<timestamp>.sql.gz`
  - Retention per `--keep N` oder `--older DAYS`
  - Defaults aus `.env` oder Ordnername
- **pgrestore**:
  - Erkennt `.sql`, `.sql.gz`, `.dump`, `.tar`
  - Optionen `--create` (DB anlegen) / `--drop` (Schema leeren)
  - Bestätigung mit `--yes` umgehen
- `.gitignore` → `.tails/` eingetragen

## 5. Git
- Alle Änderungen hochgeladen.
- `.tails/` ist von Git ausgeschlossen.

---

**Nächste Schritte**:
1. Funktionsprüfung der Kundenliste im Browser (`/admin/customers`) mit verschlüsselten Feldern.
2. Falls 500er → Tail in `.tails/save-logs/` ablegen und hochladen.
3. Erste View-Template-Optimierungen für Kundenverwaltung.
4. Testlauf pgdump/pgrestore mit aktueller Datenbank.

