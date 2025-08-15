<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <nav class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-6">
                <a href="{{ url('/') }}" class="font-semibold {{ request()->is('/') ? 'text-blue-600' : '' }}">Startseite</a>
                <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'text-blue-600 font-medium' : '' }}">Kunden-alt</a>
                <a href="{{ url('/admin') }}">Admin-alt</a>

                @can('view-customers') <a href="{{ route('customers.index') }}">Kunden</a> @endcan
                @can('admin-access') <a href="{{ route('admin.dashboard') }}">Admin</a> @endcan

                <div class="ml-auto flex items-center gap-3">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="border rounded px-3 py-1">Abmelden</button>
                    </form>
                    @endauth
                    @guest
                    <a href="{{ route('login') }}" class="border rounded px-3 py-1">Anmelden</a>
                    @endguest
                </div>
            </nav>

            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>