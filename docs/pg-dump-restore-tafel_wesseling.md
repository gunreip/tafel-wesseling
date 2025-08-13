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

## 2) Automatisierung mit systemd-User-Timer (holt Versäumtes nach)

> WSL2/Ubuntu 24.04 unterstützt systemd; User-Timer laufen im **Benutzer-Kontext** und brauchen **kein** Root.

### Schritte (Befehle/Code – kopierfähig)

#### 2.1 Service/Timer anlegen

```bash
# Verzeichnisse
mkdir -p ~/.config/systemd/user

# Service: führt pgdump-tw (dev) aus
cat > ~/.config/systemd/user/pgdump-tw.service <<'UNIT'
# /home/gunreip/.config/systemd/user/pgdump-tw.service
[Unit]
Description=Nightly DB dump (tafel-wesseling, dev)

[Service]
Type=oneshot
Environment=RETAIN_DAYS=90
# Flags: -w (no password prompt, nutzt ~/.pgpass)
ExecStart=/home/gunreip/.local/bin/pgdump-tw dev
UNIT

# Timer: täglich 18:00, mit Zufallsversatz; verpasste Läufe nachholen
cat > ~/.config/systemd/user/pgdump-tw.timer <<'UNIT'
# /home/gunreip/.config/systemd/user/pgdump-tw.timer
[Unit]
Description=Schedule nightly DB dump (tafel-wesseling, dev)

[Timer]
OnCalendar=*-*-* 18:00:00
RandomizedDelaySec=30m
Persistent=true

[Install]
WantedBy=timers.target
UNIT
```

---