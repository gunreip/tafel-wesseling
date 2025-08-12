# Tafel Wesseling – Lokales Setup & Betrieb (WSL2 · Nginx · PostgreSQL · Laravel · mkcert · Vite v4 · Tailwind/daisyUI)

> **Ziel:** Ein reproduzierbares, sauberes Dev-Setup, das **HTTPS + www** erzwingt, Laravel zuverlässig aus `/public` lädt (kein 404), stabile **DB-Sessions** nutzt und **Vite-Assets** korrekt ausliefert.
> **Konvention:** Interne Namen (Variablen/Parameter/Keys) **en‑US**, sichtbare Texte/Labels **Deutsch**.

---

## 1) Systemüberblick

- **Host:** Windows 11, Browser & mkcert-Root-CA
- **WSL2:** Ubuntu 24.04 (Noble)
- **Webstack:** Nginx 1.24, PHP-FPM 8.3, PostgreSQL
- **Datenbank:** `tafel_wesseling` (User `gunreip`)
- **Node-Tooling:** Node ≥ 18, npm, Vite 7, Tailwind CSS v4, daisyUI, `@tailwindcss/forms`
- **Projektpfad:** `/home/gunreip/code/tafel-wesseling`

**Warum diese Kombi?**

- Nginx + PHP-FPM ist leichtgewichtig und in Dev robust.
- Canonical **www** + **HTTPS only** verhindert Cookie-/CSRF-Verwirrungen und simuliert Prod-Verhalten.
- DB-Sessions sind stabiler als File-Sessions.
- Tailwind/daisyUI liefert moderne, schlanke UI-Komponenten ohne eigenes CSS-Gefrickel.

---

## 2) Hosts & Zertifikate (mkcert)

### 2.1 Hosts-Einträge

Unter Windows **und** (falls nötig) in WSL sicherstellen:

```
127.0.0.1  tafel-wesseling.local
127.0.0.1  www.tafel-wesseling.local
```

**Warum?** Lokale DNS-Auflösung der gewünschten Hostnamen.

### 2.2 mkcert – Zertifikat mit SAN (Windows)

PowerShell, z. B. in `C:\certs`:

```powershell
mkcert -cert-file "C:\certs	afel-wesseling.local.pem" -key-file "C:\certs	afel-wesseling.local-key.pem" `
  tafel-wesseling.local www.tafel-wesseling.local
```

**Warum?** Ein Zertifikat mit **Subject Alternative Name (SAN)** für **beide** Hosts verhindert `no alternative certificate subject name`.

### 2.3 Zertifikate nach WSL kopieren

```bash
sudo mkdir -p /etc/ssl/localcerts
sudo cp /mnt/c/certs/tafel-wesseling.local.pem      /etc/ssl/localcerts/tafel-wesseling.local.pem
sudo cp /mnt/c/certs/tafel-wesseling.local-key.pem  /etc/ssl/localcerts/tafel-wesseling.local-key.pem
sudo chmod 644 /etc/ssl/localcerts/tafel-wesseling.local.pem
sudo chmod 600 /etc/ssl/localcerts/tafel-wesseling.local-key.pem
```

### 2.4 Windows-Root-CA in WSL vertrauen

```bash
sudo cp /mnt/c/Users/<DEINNAME>/AppData/Local/mkcert/rootCA.pem         /usr/local/share/ca-certificates/mkcert-windows-rootCA.crt
sudo update-ca-certificates
```

**Warum?** Tools wie `curl`/OpenSSL in WSL vertrauen sonst der Windows-mkcert-CA nicht → SSL-Fehler.

---

## 3) Nginx – Canonical Redirects & Laravel aus `/public`

### 3.1 vHost-Konfiguration

`/etc/nginx/sites-available/tafel-wesseling.local.conf`

```nginx
# 80 → 443 + www
server {
    listen 80;
    listen [::]:80;
    server_name tafel-wesseling.local www.tafel-wesseling.local;
    return 301 https://www.tafel-wesseling.local$request_uri;
}

# 443 non-www → www
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name tafel-wesseling.local;

    ssl_certificate     /etc/ssl/localcerts/tafel-wesseling.local.pem;
    ssl_certificate_key /etc/ssl/localcerts/tafel-wesseling.local-key.pem;

    return 301 https://www.tafel-wesseling.local$request_uri;
}

# 443 www → Laravel (public/)
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name www.tafel-wesseling.local;

    ssl_certificate     /etc/ssl/localcerts/tafel-wesseling.local.pem;
    ssl_certificate_key /etc/ssl/localcerts/tafel-wesseling.local-key.pem;

    # WICHTIG: genau /public!
    root /home/gunreip/code/tafel-wesseling/public;
    index index.php index.html;

    # Basisschutz
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;

    access_log /var/log/nginx/tafel_wesseling_access.log;
    error_log  /var/log/nginx/tafel_wesseling_error.log;

    # Statisches Caching (Vite-Assets etc.)
    location ~* \.(?:css|js|mjs|png|jpg|jpeg|gif|ico|svg|webp|woff2?)$ {
        expires 7d;
        add_header Cache-Control "public, max-age=604800, immutable";
        access_log off;
        try_files $uri =404;
    }

    # Laravel Frontcontroller
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP-FPM (Socket ggf. Version prüfen)
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_intercept_errors on;
    }

    # Sensible Dateien/Dotfiles sperren
    location ~* \.(env|env\.backup|sqlite|log|ini|sh|bat|ps1)$ { deny all; }
    location ~ ^/storage/.*\.php$                              { deny all; }
    location ~ /\.well-known/acme-challenge/ { allow all; }
    location ~ /\.(?!well-known).* { deny all; }

    client_max_body_size 16m;
}
```

### 3.2 Aktivieren & testen

```bash
sudo ln -sf /etc/nginx/sites-available/tafel-wesseling.local.conf /etc/nginx/sites-enabled/tafel-wesseling.local.conf
sudo unlink /etc/nginx/sites-enabled/default 2>/dev/null || true
sudo nginx -t && sudo service nginx reload
```

**Rauchtest:**

```bash
curl -I http://tafel-wesseling.local          # 301 → https://www...
curl -I https://tafel-wesseling.local         # 301 → https://www...
curl -I https://www.tafel-wesseling.local     # 200
```

**Warum so?** Drei getrennte Blöcke verhindern Redirect-Loops, und nur `www:443` bedient Laravel.

---

## 4) Laravel – `.env` Kernwerte

`/home/gunreip/code/tafel-wesseling/.env` (Auszug):

```dotenv
APP_ENV=local
APP_DEBUG=true
APP_URL=https://www.tafel-wesseling.local

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=tafel_wesseling
DB_USERNAME=gunreip
DB_PASSWORD=•••

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=tafel-wesseling.local
```

Caches leeren:

```bash
php artisan key:generate   # einmalig, falls noch nicht gesetzt
php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear
```

**Warum?** `APP_URL`/`SESSION_*` müssen zur Domain/HTTPS passen (CSRF/Cookies). DB-Sessions sind robuster als Files.

---

## 5) Rechte & ACL – Webserver-Zugriff sicherstellen

### 5.1 „Traverse“-Recht bis ins Projekt

Problemfall war: `/home/gunreip` hatte `750` → `www-data` kam nicht bis `/public`.
Minimal-invasiver Fix via ACL:

```bash
sudo apt install -y acl
sudo setfacl -m u:www-data:x /home/gunreip
sudo setfacl -R -m u:www-data:rx /home/gunreip/code/tafel-wesseling
sudo setfacl -R -d -m u:www-data:rx /home/gunreip/code/tafel-wesseling
```

### 5.2 Laravel-Schreibrechte

```bash
cd /home/gunreip/code/tafel-wesseling
sudo mkdir -p storage/framework/{cache,data,sessions,testing,views} bootstrap/cache
sudo chown -R gunreip:www-data storage bootstrap/cache
sudo find storage bootstrap/cache -type d -exec chmod 2775 {} \;
sudo find storage bootstrap/cache -type f -exec chmod 0664 {} \;
sudo setfacl -R -m  u:www-data:rwx storage bootstrap/cache
sudo setfacl -R -d -m u:www-data:rwx storage bootstrap/cache
```

**Tests:**

```bash
sudo -u www-data test -r public/index.php && echo "www-data: read ok" || echo "read FAIL"
sudo -u www-data bash -lc 'echo ok > storage/framework/views/_perm_test && rm storage/framework/views/_perm_test && echo "write ok"'
```

**Warum?** Blade-Kompilate, Cache, Logs, Sessions brauchen Schreibrechte; `setgid` + Default-ACL sorgen für dauerhaft korrekte Rechte.

---

## 6) Sessions (DB) – End-to-End verifizieren

### 6.1 Migration

```bash
php artisan session:table
php artisan migrate
```

### 6.2 Test-Route (temporär)

`routes/web.php`:

```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::match(['get','post'], '/session-check', function (Request $request) {
    if ($request->isMethod('post')) {
        $data = $request->validate(['note' => ['required','string','max:100']]);
        $request->session()->put('dev_note', $data['note']); // intern en-US
        return redirect('/session-check')->with('status', 'Session aktualisiert.');
    }
    return view('dev.session-check', [
        'note' => $request->session()->get('dev_note'),
        'status' => session('status'),
    ]);
});
```

`resources/views/dev/session-check.blade.php` (Kurzform):

```blade
<!doctype html><html lang="de"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Session-Test</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head><body class="p-6">
<h1 class="text-2xl font-semibold mb-4">Session-Test</h1>
@if($status)<div class="mb-4 p-3 border rounded bg-green-50">{{ $status }}</div>@endif
<p class="mb-2">Aktueller Session-Wert: <strong>{{ $note ?? '— (leer) —' }}</strong></p>
<form method="post" action="/session-check" class="mt-4 space-y-2">@csrf
  <label class="block"><span class="block mb-1">Neue Notiz</span>
    <input name="note" class="border p-2 rounded w-full" placeholder="z. B. Hallo Session">
  </label>
  <button class="px-3 py-2 bg-blue-600 text-white rounded">Speichern</button>
</form>
<p class="text-sm text-gray-600 mt-6">Hinweis: <code>SESSION_SECURE_COOKIE=true</code> sendet das Cookie nur über HTTPS.</p>
</body></html>
```

---

## 7) Vite v4 · Tailwind/daisyUI (lokal, ohne CDN)

### 7.1 Abhängigkeiten

```bash
npm i -D tailwindcss postcss autoprefixer daisyui @tailwindcss/forms @tailwindcss/postcss
```

### 7.2 Konfigurationen

`postcss.config.cjs` (**CommonJS**, um ESM-Reibungen zu vermeiden):

```js
/* /home/gunreip/code/tafel-wesseling/postcss.config.cjs */
const tailwind = require('@tailwindcss/postcss');
const autoprefixer = require('autoprefixer');
module.exports = { plugins: [ tailwind(), autoprefixer() ] };
```

`tailwind.config.js` (**ESM**):

```js
/* /home/gunreip/code/tafel-wesseling/tailwind.config.js */
import forms from "@tailwindcss/forms";
import daisyui from "daisyui";
/** @type {import('tailwindcss').Config} */
export default {
  content: ["./resources/views/**/*.blade.php","./resources/js/**/*.{js,ts,vue}"],
  theme: { extend: {} },
  plugins: [forms, daisyui],
  daisyui: { themes:["corporate","emerald","light"], styled:true, base:true, utils:true, logs:false },
};
```

`resources/css/app.css`:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

`vite.config.js`:

```js
/* /home/gunreip/code/tafel-wesseling/vite.config.js */
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
export default defineConfig({
  plugins: [ laravel({ input: ['resources/css/app.css','resources/js/app.js'], refresh: true }) ],
})
```

### 7.3 Build & Manifest

```bash
npm run build
test -f public/build/manifest.json && echo "manifest da" || echo "manifest fehlt"
php artisan view:clear && php artisan cache:clear
```

**Warum?** Ohne Dev-Server lädt `@vite()` Assets aus `public/build` per `manifest.json`.

---

## 8) Debug-Checkliste (sehr nützlich)

**Nginx:**

```bash
sudo nginx -t
sudo nginx -T | less
sudo tail -n 100 /var/log/nginx/tafel_wesseling_error.log
```

**TLS/SAN:**

```bash
openssl s_client -connect www.tafel-wesseling.local:443 -servername www.tafel-wesseling.local -showcerts </dev/null | openssl x509 -noout -subject -ext subjectAltName
```

**Redirects:**

```bash
curl -I http://tafel-wesseling.local
curl -I https://tafel-wesseling.local
curl -I https://www.tafel-wesseling.local
```

**Rechte:**

```bash
namei -l /home/gunreip/code/tafel-wesseling/public/index.php
sudo -u www-data test -r public/index.php && echo "read ok" || echo "read FAIL"
sudo -u www-data bash -lc 'echo ok > storage/framework/views/_perm && rm storage/framework/views/_perm && echo "write ok"'
```

---

## 9) Git Snapshot & SSH (kurz)

**SSH-Key in WSL erzeugen & verwenden:**

```bash
ssh-keygen -t ed25519 -C "deine.mail@example.com" -f ~/.ssh/id_ed25519
eval "$(ssh-agent -s)" && ssh-add ~/.ssh/id_ed25519
clip.exe < ~/.ssh/id_ed25519.pub   # zum Einfügen in GitHub: https://github.com/settings/keys
```

Optionale `~/.ssh/config`:

```sshconfig
Host github.com
  HostName github.com
  User git
  IdentityFile ~/.ssh/id_ed25519
  IdentitiesOnly yes
```

**Remote setzen & pushen:**

```bash
git remote add origin git@github.com:<USER>/tafel-wesseling.git
git branch -M main
git add -A
git commit -m "Setup: www+HTTPS (Nginx), mkcert SAN, ACL/Rechte, DB sessions, Vite v4 + Tailwind/daisyUI"
git push -u origin main
```

---

## 10) Nächste Schritte (Feature-Start „Customers“)

- **Validierung zentral:** `StoreCustomerRequest` / `UpdateCustomerRequest` (intern en‑US), Fehlermeldungen **Deutsch**.
- **Filterleiste:** Name/PLZ/Ort mit PostgreSQL `ILIKE` in `scopeFilter()`.
- **UI:** Tailwind + daisyUI-Komponenten (`btn`, `input`, `card`, `table`), konsistente Form-Styles.
- **Icons (lokal):** Lucide oder Heroicons als Blade-SVGs (leicht, gut mit Tailwind).

**Warum so?** Saubere Separation (Requests/Controller/Views), nachvollziehbar und wartbar; UI einheitlich ohne CSS-Dopplungen.

---

## Appendix – „Warum diese Entscheidungen?“

- **Canonical www + HTTPS:** Einheitliche URLs, keine doppelten Cookies; auch lokal sinnvoll.
- **DB-Sessions + `SESSION_SECURE_COOKIE=true`:** Stabilität & HTTPS-Only verhindern Edgecases mit CSRF/Auth.
- **ACL + setgid:** Rechte bleiben korrekt – auch nach Deploys/Builds/Artisan-Jobs.
- **Vite Prod-Manifest:** Reproduzierbar ohne laufenden Dev-Server; Nginx liefert statische Assets flott aus.
- **Tailwind + daisyUI:** Moderne, schlanke UI mit fertigen Komponenten; lokaler Build (kein CDN), gut versionierbar.