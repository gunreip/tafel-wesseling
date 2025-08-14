<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Admin')</title>

  {{-- Vite-Assets: Tailwind-Basis + Admin-spezifische Assets --}}
  @vite(['resources/css/app.css','resources/css/admin.css','resources/js/admin.js'])

  {{-- Favicons (robust via public/) --}}
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

  @stack('styles')
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
  <header class="border-b bg-white">
    @can('admin-access')
      @include('layouts.admin.partials.admin-navbar')
    @endcan
  </header>

  <main class="admin-shell max-w-6xl mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-[220px_1fr] gap-6">
    @can('admin-access')
      <aside id="admin-sidebar" class="admin-sidebar md:col-span-1" aria-label="Admin-Navigation">
        @include('layouts.admin.partials.admin-sidebar')
      </aside>
    @endcan

    <section class="admin-content md:col-span-1" role="region" aria-label="Hauptinhalt">
      @yield('content')
    </section>
  </main>

  <footer class="border-t bg-white">
    <div class="max-w-6xl mx-auto px-4 py-4 text-sm text-gray-600">
      © {{ date('Y') }} Tafel Wesseling
    </div>
  </footer>

  @stack('scripts')
</body>
</html>
