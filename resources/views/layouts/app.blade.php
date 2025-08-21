<!DOCTYPE html>
<html lang="de" class="h-full" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tafel Wesseling</title>
  @vite(['resources/css/app.css','resources/css/nav.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-[var(--color-bg)] text-[var(--color-fg)]">
  @include('layouts.partials.navbar')

  <div id="app-shell" class="relative lg:grid lg:grid-cols-[auto_16px_1fr]">
    {{-- Sidebar: Desktop persistent, Mobile Offcanvas --}}
    @include('layouts.partials.sidebar')

    {{-- Spacer in Desktop --}}
    <div class="hidden lg:block" aria-hidden="true"></div>

    <main id="main-content" class="p-4">
      {{ $slot ?? '' }}
      @yield('content')
    </main>
  </div>

  <footer class="border-t mt-6 p-4 text-sm opacity-70">
    © {{ date('Y') }} Tafel Wesseling
  </footer>
</body>
</html>
