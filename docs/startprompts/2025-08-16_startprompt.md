# Start-Prompt – Tafel Wesseling – 2025-08-16
_Erstellt am: 2025-08-15 um 05:46 Uhr_

Wir knüpfen an den Stand vom 2025-08-15 an.

## Repository
- GitHub: <https://github.com/gunreip/tafel-wesseling>

## Scripts (Pfad)
- **`~/bin`**: `save-logs`, `save-request`, `pgdump`, `pgrestore`, **`pgstruct`**  
  **Dumps**: `./.dump/` (Schema: `./.dump/struct/`)

## Status Quo
- **Auth**: Breeze (Blade) aktiv; `/login` funktioniert.
- **Kundenbereich**: **`/customers`** (Fachbereich), via `auth` geschützt.
- **Admin-Layout**: **Variante 2** (Navbar + Sidebar im Grid, mobiler Toggle, ARIA).  
  Partials: `.../admin-navbar.blade.php`, `.../admin-sidebar.blade.php`.  
  Admin-Assets via `@vite(['resources/css/app.css','resources/css/admin.css','resources/js/admin.js'])`.
- **Assets**: Fach-Layout lädt nur `app.css/app.js`.  
- **UI-Polish**: `.table-box` für Tabellen; `.btn` als dezente Button-Basis.
- **Build-Pipeline**: Vite-Manifest, Tailwind v3 / PostCSS v8 / Autoprefixer v10, **CJS-Configs**.

## Nächste Ziele
1. **Funktionsprüfung `/customers` (End-to-End)**  
   - Lesepfad: entschlüsselte Anzeige (View), Ciphertexte in DB.  
   - Schreibpfad: Create/Store → Redirect → Klartext im Grid.  
   - Suche: Exact-Match via `whereBlind(...)` (Nachname/E-Mail).
2. **Berechtigungen**  
   - `users.role` (`user|admin`) + Hilfs-Methoden im Model.  
   - Gates: `view-customers` (user+admin), `admin-access` (nur admin).  
   - Routen: `/customers` → `auth` + `can:view-customers`; `/admin/*` → `auth` + `can:admin-access`.  
   - Menü via `@can` ein-/ausblenden; optional `CustomerPolicy` (z. B. delete nur admin).
3. **Backups/Schema**  
   - Roundtrip:
     ```bash
     pgdump --dbname=tafel_wesseling --out=./.dump/tafel_wesseling.dump
     createdb -U gunreip tafel_wesseling_test
     pgrestore --in=./.dump/tafel_wesseling.dump --dbname=tafel_wesseling_test
     ```
   - Schema-Snapshot:
     ```bash
     pgstruct --gzip
     ```
4. **Doku (kurz)**
   - Encryption-Edge-Cases (Key-Rotation, BI-Umstellung/Normalisierung, Bulk-Imports, Fehlerbilder).

## Vorgehen / Checkliste (kompakt)
```bash
php artisan optimize:clear
npm run build

# /login → anmelden → /customers:
# - Liste zeigt Klartext
# - Neu → speichern → Redirect ok
# - Suche Exact-Match (Mustermann / max@example.test)

# DB-Gegenprobe (Ciphertexte!)
psql -U gunreip -d tafel_wesseling -c "SELECT customer_no,email,last_name FROM customers LIMIT 3;"

# Rollen (falls offen)
php artisan migrate
php artisan tinker --execute="\App\Models\User::where('email','admin@example.test')->update(['role'=>'admin']);"

# Schema/Backup
pgstruct --gzip
pgdump --dbname=tafel_wesseling --out=./.dump/tafel_wesseling.dump
```
