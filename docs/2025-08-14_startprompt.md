# Start-Prompt – Tafel Wesseling – 2025-08-14

Wir setzen den Stand vom 13.08.2025 fort.

## Status Quo
- CipherSweet/Blind-Index Integration funktionsfähig.
- Key-Datei korrekt eingebunden, Rechte gesetzt.
- `save-logs` und `save-request` Scripts in `.tails/` mit Unterordnern.
- `pgdump` und `pgrestore` modernisiert und zentral installiert.
- Git-Repo aktuell, `.tails/` in `.gitignore`.

## Nächste Ziele
1. Browser-Aufruf `/admin/customers` mit funktionierender Ausgabe (verschlüsselte Felder sollen entschlüsselt angezeigt werden).
2. Falls HTTP-500 → Logs via `save-logs` sichern, hochladen, Fehler beheben.
3. Erste Anpassungen der Blade-Templates für Kundenverwaltung.
4. Testlauf von `pgdump` / `pgrestore` mit aktueller DB (Roundtrip).
5. Dokumentation erweitern: Encryption-Setup Schritt-für-Schritt.

## Vorgehen
- Zunächst Funktionstest im Browser.
- Bei Fehler → `.tails/save-logs/` prüfen und relevante Dateien bereitstellen.
- Danach UI-Verbesserungen starten.
