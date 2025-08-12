{{-- /home/gunreip/code/tafel-wesseling/resources/views/layouts/admin/partials/admin-sidebar.blade.php --}}
<aside class="menu bg-base-100 w-80 min-h-full border-r">
    <div class="px-4 py-4 border-b">
        <a href="{{ url('/') }}" class="flex items-center gap-2 font-semibold">
            <x-lucide-layout-dashboard class="w-5 h-5"/>
            <span>Startseite</span>
        </a>
        <div class="text-xs opacity-70 mt-1">{{ config('app.name', 'Tafel Wesseling') }}</div>
    </div>
    <ul class="p-4">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <x-lucide-home class="w-4 h-4"/>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="menu-title">Protokolle</li>
        <li>
            <a href="{{ route('admin.activitylog.index') }}">
                <x-lucide-clipboard-list class="w-4 h-4"/>
                <span>Aktivitäten</span>
            </a>
        </li>

        <li class="menu-title">Kunden</li>
        <li>
            <a class="disabled opacity-50">
                <x-lucide-users class="w-4 h-4"/>
                <span>Kunden (bald)</span>
            </a>
        </li>
    </ul>
</aside>
