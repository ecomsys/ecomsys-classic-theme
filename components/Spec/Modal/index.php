<?php


$id = $id ?? '';
$title = $title ?? 'Заголовок';
$description = $description ?? 'Описание';
$attrs = $attrs ?? [];
$class = $class ?? '';

// Основные классы контейнера
$base_classes = 'fixed inset-0 z-50 flex items-center justify-center transition-opacity';
// Overlay
$overlay_classes = 'fixed inset-0 bg-black/30 transition-bg';
// Модалка: на sm = full screen, на md+ = центрированная max-w-md
$modal_classes = 'bg-white text-black  min-h-[300px] sm:shadow-lg w-full h-full sm:rounded-xl sm:max-w-md sm:h-auto px-8 pb-8 pt-15 sm:pt-6 transform transition-all scale-95 opacity-0';
?>

<div id="<?= esc_attr($id); ?>" class="<?= esc_attr($base_classes); ?>" style="display:none;">
    <!-- Overlay -->
    <div class="<?= esc_attr($overlay_classes); ?>" data-modal-overlay></div>

    <!-- Модалка -->
    <div class="<?= esc_attr($modal_classes); ?>" data-modal-content>
        <!-- Крестик -->
        <button type="button" data-modal-close class="absolute top-16 sm:top-5 right-5 text-gray-500 hover:text-gray-700 cursor-pointer">
            <?php svg_icon('close', 'w-4 h-4 fill-current'); ?>
        </button>

        <!-- Заголовок -->
        <h2 class="text-xl font-bold mb-4 pr-4"><?= esc_html($title); ?></h2>

        <!-- Описание -->
        <p><?= esc_html($description); ?></p>
    </div>
</div>