// SASS
import '../scss/main.scss';

import '../tailwind/tailwind.css';

// hooks
import { useCustomizer } from './hooks/useCustomizer';
import { useActions } from './hooks/useActions';

// components
import { initDarkModeToggle } from '@/components/Spec/DarkModeToggle/DarkModeToggle';
import { initModal } from '@/components/Spec/Modal/Modal';
// import { initNavigation } from '@/components/Spec/Navigation/Navigation';

import { initNavDesktop } from '@/components/Spec/NavDesktop/NavDesktop';
import { initNavMobile } from '@/components/Spec/NavMobile/NavMobile';

document.addEventListener('DOMContentLoaded', () => {
    // hooks
    if (window.wp && wp.customize) useCustomizer(jQuery);
    useActions()

    // components
    initDarkModeToggle();
    initModal();
    initNavDesktop();
    initNavMobile();
    // initNavigation();
})


