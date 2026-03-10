// Ожидаем, что id модалки прокинут
import { useOverlayLock } from "@/assets/src/js/hooks/useOverlayLock";

export function initModal() {
    // Обрабатываем все модалки как раньше
    const modals = document.querySelectorAll('[id^="modal"]');

    modals.forEach(modal => {
        const overlay = modal.querySelector('[data-modal-overlay]');
        const content = modal.querySelector('[data-modal-content]');
        const closeBtn = modal.querySelector('[data-modal-close]');

        const openModal = () => {
            modal.style.display = 'flex';
            useOverlayLock.lock()
            requestAnimationFrame(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            });
        };

        const closeModal = () => {
            content.classList.add('scale-95', 'opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                modal.style.display = 'none';
                useOverlayLock.unlock()
            }, 200);
        };

        closeBtn?.addEventListener('click', closeModal);
        overlay?.addEventListener('click', closeModal);

        // Добавляем методы прямо к элементу для хука useGlobalActions
        modal.openModal = openModal;
        modal.closeModal = closeModal;
    });   
}