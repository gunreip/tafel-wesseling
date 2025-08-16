# Beitragen – Kurzleitfaden (Tafel Wesseling)

## Logging (~/bin/tlog)
- `tlog --section "migrate"`: Abschnitt starten (leert .tails/terminal_ausgabe).
- Optional: Aliase  
  - `tclear='tlog --clear'` – Log zurücksetzen  
  - `tsec='tlog --section'` – neuen Abschnitt beginnen  
  - `tnote='tlog --note'` – kurze Notiz anhängen

## Branch- & Commit-Stil
- Branches: `feat/...`, `fix/...`, `chore/...`, `docs/...`
- Commits: imperativ, kurz: `feat(customers): add scan-by-customer-no`
- PRs klein halten; „Tests grün, migrate:fresh grün“ als Gate.

## Umgebungsvariablen
- `.env` **nicht** committen. Nutze `.env.example` als Vorlage.
- Lokal-URL: `https://tafel-wesseling.local` (Nginx+mkcert).
- DB (dev/test): PostgreSQL, DB `tafel_wesseling`, User `gunreip` (anpassbar).
