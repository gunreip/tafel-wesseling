{{-- Mobile Overlay --}}
<div class="offcanvas-overlay" data-js="overlay" aria-hidden="true"></div>

{{-- Mobile Offcanvas as dialog --}}
<aside id="offcanvas-nav" role="dialog" aria-modal="true" aria-labelledby="offcanvas-title"
       class="offcanvas">
  <h2 id="offcanvas-title" class="sr-only">Navigation</h2>
  <nav role="navigation" aria-label="Hauptnavigation" class="nav-shell expanded">
    <div class="nav-header">Bereiche</div>
    <ul class="nav-list">

      {{-- Kunden --}}
      <li>
        <a href="{{ route('customers.index') }}"
           class="nav-item {{ request()->routeIs('customers.*') ? 'is-active' : '' }}"
           @if(request()->routeIs('customers.*')) aria-current="page" @endif
           aria-label="Kunden">
          <span class="nav-icon" aria-hidden="true">
            {{-- Lucide users --}}
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </span>
          <span class="nav-label">Kunden</span>
        </a>
      </li>

      {{-- Mitarbeiter --}}
      <li>
        <a href="{{ route('employees.index') }}"
           class="nav-item {{ request()->routeIs('employees.*') ? 'is-active' : '' }}"
           @if(request()->routeIs('employees.*')) aria-current="page" @endif
           aria-label="Mitarbeiter">
          <span class="nav-icon" aria-hidden="true">
            {{-- Lucide user-cog --}}
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M18 21a7 7 0 1 0-14 0"/><circle cx="11" cy="8" r="4"/><path d="M20.7 7.5a1.7 1.7 0 0 1 0 3.4l-1 .3-.3 1a1.7 1.7 0 0 1-3.4 0l-.3-1-1-.3a1.7 1.7 0 0 1 0-3.4l1-.3.3-1a1.7 1.7 0 0 1 3.4 0l.3 1z"/></svg>
          </span>
          <span class="nav-label">Mitarbeiter</span>
        </a>
      </li>

      {{-- Kassenbuch --}}
      <li>
        <a href="{{ route('cashbook.index') }}"
           class="nav-item {{ request()->routeIs('cashbook.*') ? 'is-active' : '' }}"
           @if(request()->routeIs('cashbook.*')) aria-current="page" @endif
           aria-label="Kassenbuch">
          <span class="nav-icon" aria-hidden="true">
            {{-- Lucide wallet --}}
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 12V7a2 2 0 0 0-2-2H7"/><path d="M3 7h16a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H3z"/><path d="M18 12h.01"/></svg>
          </span>
          <span class="nav-label">Kassenbuch</span>
        </a>
      </li>

      {{-- Berichte --}}
      <li>
        <a href="{{ route('reports.index') }}"
           class="nav-item {{ request()->routeIs('reports.*') ? 'is-active' : '' }}"
           @if(request()->routeIs('reports.*')) aria-current="page" @endif
           aria-label="Berichte">
          <span class="nav-icon" aria-hidden="true">
            {{-- Lucide bar-chart --}}
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 3v18h18"/><rect x="7" y="12" width="3" height="6"/><rect x="12" y="8" width="3" height="10"/><rect x="17" y="4" width="3" height="14"/></svg>
          </span>
          <span class="nav-label">Berichte</span>
        </a>
      </li>

      {{-- Einstellungen --}}
      <li>
        <a href="{{ route('settings.index') }}"
           class="nav-item {{ request()->routeIs('settings.*') ? 'is-active' : '' }}"
           @if(request()->routeIs('settings.*')) aria-current="page" @endif
           aria-label="Einstellungen">
          <span class="nav-icon" aria-hidden="true">
            {{-- Lucide settings --}}
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
          </span>
          <span class="nav-label">Einstellungen</span>
        </a>
      </li>

    </ul>
  </nav>
</aside>
