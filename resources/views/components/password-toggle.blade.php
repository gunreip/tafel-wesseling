@props(['id','name'])
<div class="relative">
  <input
    id="{{ $id }}" name="{{ $name }}"
    {{ $attributes->merge([
      'type' => 'password',
      'class' => 'input input-bordered w-full pr-12',
      'autocomplete' => 'off',
      'required' => true,
    ]) }}
  />
  <button
    type="button"
    class="btn btn-ghost btn-sm absolute right-2 top-1/2 -translate-y-1/2 p-0 w-8 h-8 grid place-items-center"
    data-pw-toggle="#{{ $id }}"
    data-pw-autohide-ms="10000"
    aria-label="Passwort anzeigen"
    aria-pressed="false"
  >
    <svg class="w-4 h-4 lucide-fallback" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/>
    </svg>
    <i data-lucide="eye" class="w-4 h-4"></i>
  </button>
</div>
