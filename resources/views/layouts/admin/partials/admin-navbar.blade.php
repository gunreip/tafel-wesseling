<nav class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-6">
  {{-- Link-Gruppe links --}}
  <a href="{{ url('/admin') }}" class="font-semibold {{ request()->routeIs('admin.*') ? 'text-blue-600' : '' }}">
    Admin
  </a>
  <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-medium' : '' }}">
    Dashboard
  </a>
  <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'text-blue-600 font-medium' : '' }}">
    Kunden
  </a>
  <a href="{{ url('/') }}">
    Startseite
  </a>

  {{-- Aktionen rechts --}}
  <div class="ml-auto flex items-center gap-3">
    {{-- Mobiler Sidebar-Toggle (nur < md sichtbar) --}}
    <button type="button"
            class="sidebar-toggle md:hidden border rounded px-3 py-1"
            aria-controls="admin-sidebar"
            aria-expanded="false">
      Menü
    </button>

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
