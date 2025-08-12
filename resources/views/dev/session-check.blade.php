<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Session-Test</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="p-6">
  <h1 class="text-2xl font-semibold mb-4">Session-Test</h1>

  @if($status)
    <div class="mb-4 p-3 border rounded bg-green-50">{{ $status }}</div>
  @endif

  <p class="mb-2">Aktueller Session-Wert: <strong>{{ $note ?? '— (leer) —' }}</strong></p>

  <form method="post" action="/session-check" class="mt-4 space-y-2">
    @csrf
    <label class="block">
      <span class="block mb-1">Neue Notiz (max. 100 Zeichen)</span>
      <input name="note" class="border p-2 rounded w-full" placeholder="z. B. Hallo Session">
    </label>
    <button class="px-3 py-2 bg-blue-600 text-white rounded">Speichern</button>
  </form>

  <p class="text-sm text-gray-600 mt-6">
    Hinweis: <code>SESSION_SECURE_COOKIE=true</code> sendet das Cookie nur über HTTPS.
    Aufruf daher über <strong>https://www.tafel-wesseling.local/session-check</strong>.
  </p>
</body>
</html>
