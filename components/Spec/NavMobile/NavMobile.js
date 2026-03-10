// modules/initOffcanvasMenu.js
import { overlay } from "@/assets/src/js/hooks/useOverlay";

export function initNavMobile() {
  const burger = document.querySelector('.header__burger');
  const offcanvas = document.querySelector('.offcanvas');
  const closeBtn = offcanvas.querySelector('.offcanvas__close');
  const menuItems = offcanvas.querySelectorAll('.offcanvas__item--has-children');

  if (!burger || !offcanvas || !closeBtn) return;

  // Высчитываем высоту админ бара вордпресс
  function applyAdminBarOffset() {
    if (!document.body.classList.contains('admin-bar')) return;
    const adminBar = document.getElementById('wpadminbar');
    if (!adminBar) return;

    const updateOffset = () => {
      const height = adminBar.getBoundingClientRect().height;
      offcanvas.style.paddingTop = `${height}px`;

    };
    updateOffset();
    window.addEventListener('resize', updateOffset);
  }
  applyAdminBarOffset();

  // Оверлей
  const Overlay = overlay();
  Overlay?.closeClickInit();

  // Открытие канваса
  burger.addEventListener('click', () => {
    offcanvas.classList.add('active');
    Overlay?.open();
  });

  // Закрытие канваса
  closeBtn.addEventListener('click', () => {
    closeAllSubmenus();
    offcanvas.classList.remove('active');
    Overlay?.close();
  });

  Overlay?.el.addEventListener("click", () => {
    offcanvas.classList.remove("active");
    Overlay?.close();
  });

  // Закрытие всех аккордеонов
  function closeAllSubmenus() {
    menuItems.forEach(item => item.classList.remove('offcanvas__item--open'));
  }

  // Toggle аккордеон при клике
  menuItems.forEach(item => {
    const link = item.querySelector('.offcanvas__link');
    link.addEventListener('click', () => {
      const isOpen = item.classList.contains('offcanvas__item--open');
      closeAllSubmenus();
      if (!isOpen) {
        item.classList.add('offcanvas__item--open');
      }
    });
  });

  return true;
}