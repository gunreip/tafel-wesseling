# tafel-wesseling – Tageszusammenfassung 2025-08-13
_Erstellt am: 2025-08-13 um 05:41 Uhr_
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


## Quickfacts (aktuell)

**Branch: main — letzte 5 Commits**
```
fb310d4 docs: EoD 2025-08-14 (+auto-sections) + Start-Prompt 2025-08-15
7fdce4a docs: EoD 2025-08-14 + Start-Prompt 2025-08-15
cdbcad4 docs: Start-Prompt für 2025-08-14
45bd87f docs: Tageszusammenfassung 2025-08-13
fe2ae7c docs: Tageszusammenfassung 2025-08-13
```

## Route-Liste (artisan route:list)

**php artisan route:list**
```

  GET|HEAD   admin/admin/customers ................................................................................................................................................................................................ admin.admin.customers.index › Admin\CustomerController@index
  POST       admin/admin/customers ................................................................................................................................................................................................ admin.admin.customers.store › Admin\CustomerController@store
  GET|HEAD   admin/admin/customers/create ....................................................................................................................................................................................... admin.admin.customers.create › Admin\CustomerController@create
  GET|HEAD   admin/customers ............................................................................................................................................................................................................ admin.customers.index › Admin\CustomerController@index
  POST       admin/customers ............................................................................................................................................................................................................ admin.customers.store › Admin\CustomerController@store
  GET|HEAD   admin/customers/create ................................................................................................................................................................................................... admin.customers.create › Admin\CustomerController@create
  GET|HEAD   admin/history ............................................................................................................................................................................................................. admin.history.index › Admin\ActivityLogController@index
  GET|POST|HEAD session-check .................................................................................................................................................................................................................................................................. 
  GET|HEAD   storage/{path} ...................................................................................................................................................................................................................................................... storage.local
  GET|HEAD   up ................................................................................................................................................................................................................................................................................ 

                                                                                                                                                                                                                                                                             Showing [10] routes
```

## Migrationsstatus (artisan migrate:status)

**php artisan migrate:status**
```

  Migration name .................................................................................................................... Batch / Status  
  0001_01_01_000000_create_users_table ..................................................................................................... [1] Ran  
  0001_01_01_000001_create_cache_table ..................................................................................................... [1] Ran  
  0001_01_01_000002_create_jobs_table ...................................................................................................... [1] Ran  
  2025_08_10_120306_create_notifications_table ............................................................................................. [1] Ran  
  2025_08_10_122533_create_activity_log_table .............................................................................................. [2] Ran  
  2025_08_10_122534_add_event_column_to_activity_log_table ................................................................................. [2] Ran  
  2025_08_10_122535_add_batch_uuid_column_to_activity_log_table ............................................................................ [2] Ran  
  2025_08_10_123646_create_customers_table ................................................................................................. [3] Ran  
  2025_08_12_191712_create_countries_table ................................................................................................. [4] Ran  
  2025_08_12_191712_create_customers_table ................................................................................................. [5] Ran  
  2025_08_12_191712_enable_pgcrypto_extension .............................................................................................. [5] Ran  
  2025_08_12_191713_create_customer_identities_table ....................................................................................... [5] Ran  
  2025_08_12_191713_create_customer_residences_table ....................................................................................... [5] Ran  
  2025_08_13_052710_create_blind_indexes_table ............................................................................................. [6] Ran  
  2025_08_13_052755_alter_customer_residences_for_ciphersweet .............................................................................. [7] Ran  
  2025_08_13_052755_alter_customers_for_ciphersweet ........................................................................................ [7] Ran  
  2025_08_13_112524_ensure_pg_uuid_extension ............................................................................................... [8] Ran  
  2025_08_13_134013_create_blind_indexes_table ............................................................................................. [9] Ran  
```

## Composer-Paketstände (Auszug)

**composer show (Auszug)**
```

                                                                                 
  Too many arguments to "show" command, expected arguments "package" "version".  
                                                                                 

show [--all] [--locked] [-i|--installed] [-p|--platform] [-a|--available] [-s|--self] [-N|--name-only] [-P|--path] [-t|--tree] [-l|--latest] [-o|--outdated] [--ignore IGNORE] [-M|--major-only] [-m|--minor-only] [--patch-only] [-A|--sort-by-age] [-D|--direct] [--strict] [-f|--format FORMAT] [--no-dev] [--ignore-platform-req IGNORE-PLATFORM-REQ] [--ignore-platform-reqs] [--] [<package> [<version>]]
```

## Laravel Log Tail (letzte 120 Zeilen)

**tail -n 120 storage/logs/laravel.log**
```
[stacktrace]
#0 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(59): Illuminate\\View\\Engines\\CompilerEngine->handleViewException()
#1 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()
#2 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get()
#3 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/View.php(191): Illuminate\\View\\View->getContents()
#4 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/View.php(160): Illuminate\\View\\View->renderContents()
#5 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Response.php(78): Illuminate\\View\\View->render()
#6 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Response.php(34): Illuminate\\Http\\Response->setContent()
#7 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(939): Illuminate\\Http\\Response->__construct()
#8 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(906): Illuminate\\Routing\\Router::toResponse()
#9 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(821): Illuminate\\Routing\\Router->prepareResponse()
#10 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Routing\\Router->Illuminate\\Routing\\{closure}()
#11 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#12 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#13 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/VerifyCsrfToken.php(87): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#14 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken->handle()
#15 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/Middleware/ShareErrorsFromSession.php(48): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#16 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\View\\Middleware\\ShareErrorsFromSession->handle()
#17 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php(120): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#18 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php(63): Illuminate\\Session\\Middleware\\StartSession->handleStatefulRequest()
#19 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Session\\Middleware\\StartSession->handle()
#20 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/AddQueuedCookiesToResponse.php(36): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#21 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse->handle()
#22 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php(74): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#23 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Cookie\\Middleware\\EncryptCookies->handle()
#24 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#25 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(821): Illuminate\\Pipeline\\Pipeline->then()
#26 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(800): Illuminate\\Routing\\Router->runRouteWithinStack()
#27 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(764): Illuminate\\Routing\\Router->runRoute()
#28 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(753): Illuminate\\Routing\\Router->dispatchToRoute()
#29 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#30 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Foundation\\Http\\Kernel->Illuminate\\Foundation\\Http\\{closure}()
#31 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#32 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#33 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#34 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#35 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#36 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#37 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#38 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#39 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#40 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#41 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Middleware/HandleCors.php(48): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#42 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Http\\Middleware\\HandleCors->handle()
#43 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#44 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#45 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#46 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#47 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#48 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#49 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#50 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#51 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#52 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#53 /home/gunreip/code/tafel-wesseling/public/index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#54 {main}

[previous exception] [object] (InvalidArgumentException(code: 0): View [layouts.admin.app] not found. at /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/FileViewFinder.php:138)
[stacktrace]
#0 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/FileViewFinder.php(78): Illuminate\\View\\FileViewFinder->findInPaths()
#1 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/Factory.php(150): Illuminate\\View\\FileViewFinder->find()
#2 /home/gunreip/code/tafel-wesseling/storage/framework/views/f55886cf899c6c27f2de3f11afdc53c6.php(71): Illuminate\\View\\Factory->make()
#3 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(123): require('...')
#4 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php(124): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()
#5 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/Engines/PhpEngine.php(57): Illuminate\\Filesystem\\Filesystem->getRequire()
#6 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/Engines/CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath()
#7 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get()
#8 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/View.php(191): Illuminate\\View\\View->getContents()
#9 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/View.php(160): Illuminate\\View\\View->renderContents()
#10 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Response.php(78): Illuminate\\View\\View->render()
#11 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Response.php(34): Illuminate\\Http\\Response->setContent()
#12 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(939): Illuminate\\Http\\Response->__construct()
#13 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(906): Illuminate\\Routing\\Router::toResponse()
#14 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(821): Illuminate\\Routing\\Router->prepareResponse()
#15 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Routing\\Router->Illuminate\\Routing\\{closure}()
#16 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#17 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle()
#18 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/VerifyCsrfToken.php(87): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#19 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken->handle()
#20 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/View/Middleware/ShareErrorsFromSession.php(48): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#21 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\View\\Middleware\\ShareErrorsFromSession->handle()
#22 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php(120): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#23 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php(63): Illuminate\\Session\\Middleware\\StartSession->handleStatefulRequest()
#24 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Session\\Middleware\\StartSession->handle()
#25 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/AddQueuedCookiesToResponse.php(36): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#26 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse->handle()
#27 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php(74): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#28 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Cookie\\Middleware\\EncryptCookies->handle()
#29 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#30 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(821): Illuminate\\Pipeline\\Pipeline->then()
#31 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(800): Illuminate\\Routing\\Router->runRouteWithinStack()
#32 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(764): Illuminate\\Routing\\Router->runRoute()
#33 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Routing/Router.php(753): Illuminate\\Routing\\Router->dispatchToRoute()
#34 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(200): Illuminate\\Routing\\Router->dispatch()
#35 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Foundation\\Http\\Kernel->Illuminate\\Foundation\\Http\\{closure}()
#36 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#37 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ConvertEmptyStringsToNull.php(31): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#38 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle()
#39 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#40 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle()
#41 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle()
#42 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#43 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Http\\Middleware\\ValidatePostSize->handle()
#44 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php(109): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#45 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle()
#46 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Middleware/HandleCors.php(48): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#47 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Http\\Middleware\\HandleCors->handle()
#48 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#49 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Http\\Middleware\\TrustProxies->handle()
#50 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#51 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle()
#52 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePathEncoding.php(26): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#53 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(219): Illuminate\\Http\\Middleware\\ValidatePathEncoding->handle()
#54 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()
#55 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(175): Illuminate\\Pipeline\\Pipeline->then()
#56 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(144): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter()
#57 /home/gunreip/code/tafel-wesseling/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(1219): Illuminate\\Foundation\\Http\\Kernel->handle()
#58 /home/gunreip/code/tafel-wesseling/public/index.php(20): Illuminate\\Foundation\\Application->handleRequest()
#59 {main}
"} 
```
