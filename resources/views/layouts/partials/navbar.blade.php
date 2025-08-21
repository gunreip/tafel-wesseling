<header class="w-full h-14 flex items-center justify-between px-4 border-b bg-white dark:bg-neutral-900 z-30">
  <a href="#main-content" class="skip-link">Zum Inhalt springen</a>

  <div class="flex items-center gap-3">
    <button
      type="button"
      class="nav-toggle btn btn-ghost btn-sm"
      aria-controls="offcanvas-nav"
      aria-expanded="false"
      aria-label="Navigation öffnen">
      <!-- Lucide: menu -->
      <svg class="w-5 h-5" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
      <span class="sr-only">Menü</span>
    </button>
    <div class="font-semibold">Tafel Wesseling</div>
  </div>

  <div class="flex items-center gap-3">
    <a href="{{ route('profile.edit') }}" class="link link-hover">Profil</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn btn-sm">Abmelden</button>
    </form>
  </div>
</header>
