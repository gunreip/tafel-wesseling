{{-- /home/gunreip/code/tafel-wesseling/resources/views/layouts/admin/partials/admin-navbar.blade.php --}}
<div class="navbar bg-base-100 border-b">
    <div class="flex-none lg:hidden">
        <label for="admin-drawer" class="btn btn-ghost">
            <x-lucide-menu class="w-5 h-5" />
        </label>
    </div>
    <div class="flex-1">
        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-medium' : '' }}">
            Admin
        </a>
    </div>
    <div class="flex-none gap-2 pr-2">
        <div class="tooltip" data-tip="Suche">
            <button class="btn btn-ghost btn-circle">
                <x-lucide-search class="w-5 h-5" />
            </button>
        </div>
        <div class="tooltip" data-tip="Benutzer">
            <button class="btn btn-ghost btn-circle">
                <x-lucide-user class="w-5 h-5" />
            </button>
        </div>
    </div>
</div>