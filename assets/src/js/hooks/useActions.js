export function useActions() {
    // --- Универсальная глобальная функция ---
    // Параметр: { selector: string, action: string, args: array }
    window.actions = function({ selector, action = 'openModal', args = [] }) {
        if (!selector) {
            console.warn('ActionBySelector: selector is required');
            return;
        }

        // Находим все элементы по селектору (id, класс, тег)
        const elements = document.querySelectorAll(selector);

        if (!elements.length) {
            console.warn(`ActionBySelector: no elements found for selector "${selector}"`);
            return;
        }

        elements.forEach(el => {
            if (typeof el[action] === 'function') {
                el[action](...args);
            } else {
                console.warn(`ActionBySelector: action "${action}" not found on element`, el);
            }
        });
    };
}