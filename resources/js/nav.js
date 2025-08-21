const NS = 'ui:nav:v1';
const KEY = `${NS}:collapsed`;

function isDesktop() {
  return window.matchMedia('(min-width: 1024px)').matches; // lg
}

function getShell() {
  return document.getElementById('app-shell') || document.body;
}

function setAriaExpanded(btn, expanded) {
  if (!btn) return;
  btn.setAttribute('aria-expanded', String(expanded));
  btn.setAttribute('aria-label', expanded ? 'Navigation schließen' : 'Navigation öffnen');
}

function loadCollapsed() {
  try {
    const raw = localStorage.getItem(KEY);
    return raw === 'true';
  } catch { return false; }
}

function saveCollapsed(v) {
  try { localStorage.setItem(KEY, v ? 'true' : 'false'); } catch {}
}

function openMobile() {
  const shell = getShell();
  document.body.classList.add('has-overlay');
  shell.classList.add('is-open');
  // Focus to first nav link
  const first = document.querySelector('.offcanvas .nav-item');
  if (first) first.focus();
}

function closeMobile() {
  const shell = getShell();
  document.body.classList.remove('has-overlay');
  shell.classList.remove('is-open');
}

function onResize() {
  const shell = getShell();
  if (isDesktop()) {
    // Cleanup mobile artifacts
    closeMobile();
    document.body.classList.remove('has-overlay');

    const collapsed = loadCollapsed();
    shell.classList.toggle('is-collapsed', collapsed);
    const toggle = document.querySelector('.nav-toggle');
    setAriaExpanded(toggle, !collapsed);
  } else {
    // Mobile default: closed
    const toggle = document.querySelector('.nav-toggle');
    setAriaExpanded(toggle, false);
  }
}

function initNav() {
  const shell = getShell();
  const toggle = document.querySelector('.nav-toggle');
  const overlay = document.querySelector('[data-js="overlay"]');

  // Initial hydrate
  onResize();

  // Toggle click
  toggle?.addEventListener('click', () => {
    if (isDesktop()) {
      const collapsed = shell.classList.toggle('is-collapsed');
      setAriaExpanded(toggle, !collapsed);
      saveCollapsed(collapsed);
    } else {
      const isOpen = shell.classList.contains('is-open');
      if (isOpen) { closeMobile(); toggle?.focus(); }
      else { openMobile(); }
    }
  });

  // Overlay click (mobile)
  overlay?.addEventListener('click', () => {
    if (!isDesktop()) { closeMobile(); toggle?.focus(); }
  });

  // ESC close (mobile only)
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !isDesktop()) {
      if (getShell().classList.contains('is-open')) {
        closeMobile();
        toggle?.focus();
      }
    }
  });

  // Resize
  window.addEventListener('resize', onResize);
}

document.addEventListener('DOMContentLoaded', initNav);
