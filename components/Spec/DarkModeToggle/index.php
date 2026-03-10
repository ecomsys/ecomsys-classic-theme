<?php
/**
 * Dark Mode Toggle Component
 *
 * Можно вызывать через render_component('UI.DarkModeToggle')
 */
?>

<button
    class="cursor-pointer dark-mode-toggle flex items-center justify-center w-12 h-12 p-2 text-gray-900 dark:text-gray-100 transition-colors duration-300"
    aria-label="Toggle Dark Mode"
>
    <span class="icon-light text-white">
        <?php svg_icon('moon', 'w-6 h-6'); ?>
    </span>
    <span class="icon-dark text-white hidden">
        <?php svg_icon('sun', 'w-6 h-6'); ?>
    </span>
</button>