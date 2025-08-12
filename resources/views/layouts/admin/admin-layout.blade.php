{{-- /home/gunreip/code/tafel-wesseling/resources/views/layouts/admin/admin-layout.blade.php --}}
@php $appName = config('app.name', 'Tafel Wesseling'); @endphp
<!DOCTYPE html>
<html lang="de" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName }} — @yield('title', 'Admin') </title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-dvh bg-base-200 text-base-content">
    <div class="drawer lg:drawer-open">
        <input id="admin-drawer" type="checkbox" class="drawer-toggle"/>
        <div class="drawer-content flex flex-col">
            @include('layouts.admin.partials.admin-navbar')

            <main class="p-4 lg:p-6">
                <div class="breadcrumbs text-sm mb-4">
                    @yield('breadcrumbs')
                </div>

                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h1 class="card-title">@yield('page_heading', 'Übersicht')</h1>
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>

        <div class="drawer-side z-40">
            <label for="admin-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            @include('layouts.admin.partials.admin-sidebar')
        </div>
    </div>
</body>
</html>
