export const useOverlayLock = (() => {
    let openCount = 0; // счетчик открытых overlay

    const applyLock = () => {
        document.body.style.overflow = 'hidden';
        document.documentElement.style.scrollbarGutter = 'stable';
    };

    const removeLock = () => {
        document.body.style.overflow = '';
        document.documentElement.style.scrollbarGutter = '';
    };

    return {
        lock: () => {
            if (openCount === 0) applyLock();
            openCount++;
        },

        unlock: () => {
            openCount = Math.max(0, openCount - 1);
            if (openCount === 0) removeLock();
        },

        toggle: () => {
            if (openCount === 0) {
                // если overlay закрыт — открываем
                openCount++;
                applyLock();
            } else {
                // если overlay открыт — закрываем
                openCount = Math.max(0, openCount - 1);
                if (openCount === 0) removeLock();
            }
        }
    };
})();