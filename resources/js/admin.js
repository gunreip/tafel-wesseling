document.addEventListener('DOMContentLoaded', () => {
  const btn = document.querySelector('.sidebar-toggle');
  const sidebar = document.getElementById('admin-sidebar');
  if (!btn || !sidebar) return;

  btn.addEventListener('click', () => {
    const isOpen = sidebar.getAttribute('data-state') === 'open';
    sidebar.setAttribute('data-state', isOpen ? 'closed' : 'open');
    btn.setAttribute('aria-expanded', String(!isOpen));
  });
});
