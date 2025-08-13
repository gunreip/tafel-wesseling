# tafel-wesseling – Tageszusammenfassung 2025-08-14

## 1. Heutige Schwerpunkte
- CipherSweet/Blind-Index konfiguriert und getestet (Exact-Match via `whereBlind`).
- Key-Datei per `FileProvider` eingebunden; PHP-FPM-Leserechte gesetzt.
- Logging-Tools: `save-logs`, `save-request` mit Ablage in `./.tails/` (Unterordner).
- Backups: `pgdump` & `pgrestore` zentral modernisiert (Outputs in `./.tails/backup/`).



## 2. Offene Punkte / To-dos
- Browser-Check `/admin/customers` (Fehlerfall → `save-logs` laufen lassen).
- UI-Verbesserungen Kundenübersicht (Blade).
- Doku ausbauen: Schritt-für-Schritt zur Verschlüsselung.

## 3. Quickfacts (automatisch)
- Branch: `main`
- Letzte Commits:
```
cdbcad4 docs: Start-Prompt für 2025-08-14
45bd87f docs: Tageszusammenfassung 2025-08-13
fe2ae7c docs: Tageszusammenfassung 2025-08-13
d881f90 Ffull project upload for checking
5b23dd1 chore(git): ignore VSCode helpers directory
```

