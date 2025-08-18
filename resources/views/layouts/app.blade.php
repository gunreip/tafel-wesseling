<!doctype html>
<html lang="de" data-theme="light">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Tafel Wesseling')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-100">
  <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:p-2 focus:bg-base-200">Zum Inhalt springen</a>
  <header role="banner" class="border-b border-base-300">@include('partials.app.navbar')</header>
  <main id="content" class="p-6">@yield('content')</main>
</body>
</html>
