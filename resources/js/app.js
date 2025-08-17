import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function initPasswordToggles() {
  document.querySelectorAll('[data-pw-toggle]').forEach((btn) => {
    const sel = btn.getAttribute('data-pw-toggle');
    const input = document.querySelector(sel);
    if (!input) return;

    btn.addEventListener('click', () => {
      const isText = input.getAttribute('type') === 'text';
      input.setAttribute('type', isText ? 'password' : 'text');

      btn.setAttribute('aria-pressed', String(!isText));
      btn.setAttribute('aria-label', isText ? 'Passwort anzeigen' : 'Passwort verbergen');

      const icon = btn.querySelector('[data-lucide]');
      if (icon) icon.setAttribute('data-lucide', isText ? 'eye' : 'eye-off');
      // Lucide neu zeichnen
      if (typeof createIcons === 'function') createIcons(); initPasswordToggles();
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  try { initPasswordToggles(); } catch (_) {}
});
