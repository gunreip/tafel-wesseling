<div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="{{ route('customers.index') }}" class="btn btn-ghost text-lg font-semibold">Tafel Wesseling</a>
  </div>
  <div class="flex-none">
    <a href="{{ route('customers.index') }}"
       class="btn btn-ghost btn-sm"
       aria-current="{{ request()->routeIs('customers.*') ? 'page' : 'false' }}">
      Kunden
    </a>
    @auth
      <a href="{{ route('profile.edit') }}" class="btn btn-ghost btn-sm">Profil</a>
      <form method="POST" action="{{ route('logout') }}" class="inline">@csrf
        <button type="submit" class="btn btn-ghost btn-sm">Abmelden</button>
      </form>
    @endauth
    <a href="{{ url('/') }}" class="btn btn-ghost btn-sm">Start</a>
  </div>
</div>
