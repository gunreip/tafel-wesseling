# Start-Prompt – tafel-wesseling – 2025-08-14
_Erstellt am: 2025-08-13 um 05:41 Uhr_

Wir knüpfen an den Stand vom 2025-08-13 an.

## Status Quo
- CipherSweet/Blind-Index lauffähig (Exact-Match).
- Key-Datei & Rechte korrekt.
- Tools: `save-logs`, `save-request`, `pgdump`, `pgrestore` zentral installiert.
- `.tails/` in `.gitignore`.

## Nächste Ziele
1. `/admin/customers` im Browser prüfen (verschlüsselte Felder sollen entschlüsselt angezeigt werden).
2. Bei Fehler: `save-logs` ausführen, Log hochladen.
3. Blade-Templates der Kundenverwaltung glätten (Layout/Navigation).
4. Roundtrip-Test: `pgdump` → `pgrestore`.
5. Doku: Encryption-Setup erweitern (Edge-Cases).

## Vorgehen
- Erst Funktionsprüfung im Browser.
- Fehler → Logs sammeln → Analyse.
- Danach UI-Verbesserungen.
