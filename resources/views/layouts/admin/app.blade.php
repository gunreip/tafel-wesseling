<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin')</title>
  @vite([
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/css/admin.css',
    'resources/js/admin.js'
    ])
  @stack('styles')
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-64.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-16.png') }}">
  <!-- <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}"> -->
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
  <header class="border-b bg-white">
    <nav class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-6">
      <a href="{{ url('/admin') }}" class="font-semibold">Admin</a>
      <!-- <a href="{{ route('customers.index') }}">Kunden</a> -->
      <a href="{{ url('/') }}">Startseite</a>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto px-4 py-6">
    @yield('content')
  </main>

  <footer class="border-t bg-white">
    <div class="max-w-6xl mx-auto px-4 py-4 text-sm text-gray-600">
      © {{ date('Y') }} Tafel Wesseling
    </div>
  </footer>

  @stack('scripts')
</body>
</html>
