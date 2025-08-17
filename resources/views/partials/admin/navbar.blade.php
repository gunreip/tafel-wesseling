<div class="navbar bg-base-100">
  <div class="flex-1">
    <button id="sidebarToggle" class="btn btn-ghost lg:hidden" aria-controls="sidebar" aria-expanded="false" aria-label="Menü umschalten">
      <i data-lucide="menu" class="w-5 h-5"></i>
    </button>
    <a href="{{ url('/admin') }}" class="btn btn-ghost text-lg font-semibold">Tafel Wesseling</a>
  </div>
  <div class="flex-none">
    @auth
    <a href="{{ route('profile.edit') }}" class="btn btn-ghost btn-sm" aria-current="{{ request()->routeIs('profile.*') ? 'page' : 'false' }}">Profil</a>
    <form method="POST" action="{{ route('logout') }}" class="inline">@csrf
      <button type="submit" class="btn btn-ghost btn-sm">Abmelden</button>
    </form>
    @endauth
    <a href="{{ url('/') }}" class="btn btn-ghost btn-sm">Start</a>
  </div>
</div>
