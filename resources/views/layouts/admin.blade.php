<!doctype html>
<html lang="de" data-theme="light">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Admin – Tafel Wesseling')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-100">
  <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:p-2 focus:bg-base-200">Zum Inhalt springen</a>
  <header role="banner" class="border-b border-base-300">@include('partials.admin.navbar')</header>
  <div class="grid lg:grid-cols-[16rem_1fr]">
    <nav id="sidebar" role="navigation" aria-label="Hauptmenü" class="border-r border-base-300 hidden lg:block">
      @include('partials.admin.sidebar')
    </nav>
    <main id="content" class="p-6">@yield('content')</main>
  </div>
</body>
</html>
