export function initDarkModeToggle() {
    const btns = document.querySelectorAll('.dark-mode-toggle');
    if (!btns || btns.length === 0) return;

    const updateButtonIcons = (btn) => {
        const isDark = document.documentElement.classList.contains('dark');
        const lightIcon = btn.querySelector('.icon-light');
        const darkIcon = btn.querySelector('.icon-dark');

        if (isDark) {
            lightIcon.classList.add('hidden');
            darkIcon.classList.remove('hidden');
        } else {
            lightIcon.classList.remove('hidden');
            darkIcon.classList.add('hidden');
        }
    };

    // Иконка при загрузке
    btns.forEach(btn => updateButtonIcons(btn));

    // Восстановление темы из localStorage
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
        btns.forEach(btn => updateButtonIcons(btn));
    }

    // Обработчик клика
    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');

            // Обновляем все кнопки сразу
            btns.forEach(b => updateButtonIcons(b));

            // Сохраняем выбор
            localStorage.setItem(
                'theme',
                document.documentElement.classList.contains('dark') ? 'dark' : 'light'
            );
        });
    });
}