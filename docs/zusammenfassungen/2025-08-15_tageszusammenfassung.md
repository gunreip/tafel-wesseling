# Tageszusammenfassung – 2025-08-15

**Erreicht**
- **Auth**: Laravel Breeze (Blade) installiert; **/login** funktioniert.  
- **Kundenbereich**: von **/admin/customers** nach **/customers** verlagert; via `auth` geschützt (Fachbereich).  
- **Admin-Layout (Variante 2)**: Navbar + Sidebar als Grid, **mobiler Toggle**, ARIA-Labels.  
  Partials: `resources/views/layouts/admin/partials/admin-navbar.blade.php`, `resources/views/layouts/admin/partials/admin-sidebar.blade.php`.  
- **Assets getrennt**: Fach-Layout lädt `app.css/app.js`; Admin-Layout zusätzlich `admin.css/admin.js`.  
- **Tabellen-Polish**: `.table-box` (runde Ecken sauber via `border-separate` + `overflow:hidden`).  
- **Vite/Tailwind stabilisiert**:  
  - Vite-Inputs vollständig (`app.css/js`, `admin.css/js`), **Manifest-Modus** (kein HMR).  
  - **Tailwind v3 / PostCSS v8 / Autoprefixer v10** hart gepinnt.  
  - **CJS-Configs**: `tailwind.config.cjs`, `postcss.config.cjs`.  
  - `resources/css/app.css` enthält die drei `@tailwind`-Direktiven.  
- **Tooling**: Neues Script **`pgstruct`** in **`~/bin`**; schreibt Schema-Dumps nach **`./.dump/struct/`**.  
- **Favicons**: aus `public/` eingebunden.

**Offen / zu verifizieren**
- Gates/Policies finalisieren: `view-customers`, `admin-access`, optional `CustomerPolicy`.  
- `/customers`: Entschlüsselung & Blind-Index-Suche End-to-End prüfen (Lesen/Schreiben/Suchen).  
- Roundtrip: `pgdump → pgrestore` + Schema-Snapshot mit `pgstruct`.  
- Doku: Encryption-Edge-Cases (Key-Rotation, BI-Änderungen, Bulk-Imports, Fehlerbilder).

