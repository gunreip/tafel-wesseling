# /home/gunreip/code/tafel-wesseling/docs/db-backups.md
cat > /home/gunreip/code/tafel-wesseling/docs/db-backups.md <<'MD'
# DB-Backups (PostgreSQL) – Tafel Wesseling

## Tools

### `pgdump-tw`
Erstellt einen **Custom-Dump** (`.dump`) der DB `tafel_wesseling` und einen **lesbaren Report** (`.txt`) daneben.  
**Ablage:** `~/backups/sql/tafel-wesseling/<env>/<year>/…`  
**Retention:** löscht Dumps **älter als 90 Tage**, behält **immer den neuesten** im Ordner.  
**ENV-Variablen:**  
- `RETAIN_DAYS` (Default **90**): Aufbewahrungszeit  
- `PRUNE_DRY_RUN=1`: zeigt nur, was gelöscht würde  
- `DB_HOST`/`DB_PORT`/`DB_USER`: DB-Zugriff anpassen

**Beispiele**
```bash
pgdump-tw dev
RETAIN_DAYS=30 pgdump-tw dev
PRUNE_DRY_RUN=1 pgdump-tw dev
```

---