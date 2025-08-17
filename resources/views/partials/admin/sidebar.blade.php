<ul class="menu p-4">
  <li>
    <a href="{{ route('admin.dashboard') }}"
       @class(['active'=> request()->routeIs('admin.dashboard') ])
       aria-current="{{ request()->routeIs('admin.dashboard') ? 'page' : 'false' }}">
      <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
      <span class="ml-2">Übersicht</span>
    </a>
  </li>
</ul>
