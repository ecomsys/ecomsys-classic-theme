<?php

// render_component('Button', [
//     'variant' => 'primary',
//     'slot' => 'Открыть модалку',
//     'attrs' => [
//         'type' => 'button',
//         'data-action-id' => 'simple-modal',
//         'data-action' => 'openModal',
//         'onclick' => 'wp_action({selector: "#simple-modal", action: "openModal"})'
//     ],
// ]);

$variant = $variant ?? 'primary';
$type = $type ?? 'button';
$slot = $slot ?? '';
$attrs = $attrs ?? [];
$class = $class ?? '';

$base_classes = 'inline-flex items-center justify-center rounded-lg font-medium transition duration-200 focus:outline-none';

$variants = [
    'primary' => 'bg-blue-600 text-white hover:bg-blue-700  disabled:opacity-60 disabled:hover:bg-blue-600 cursor-pointer disabled:cursor-not-allowed',
    'secondary' => 'bg-gray-600 text-white hover:bg-gray-700  disabled:opacity-60 disabled:hover:bg-gray-600 cursor-pointer disabled:cursor-not-allowed',
    'success' => 'bg-green-600 text-white hover:bg-green-700  disabled:opacity-60 disabled:hover:bg-green-600 cursor-pointer disabled:cursor-not-allowed',
    'danger' => 'bg-red-600 text-white hover:bg-red-700  disabled:opacity-60 disabled:hover:bg-red-600 cursor-pointer disabled:cursor-not-allowed',
];

$variant_classes = $variants[$variant] ?? $variants['primary'];

$classes = trim("$base_classes $variant_classes px-4 py-2 $class");

/**
 * Формируем строку атрибутов
 */
$attributes_string = '';

foreach ($attrs as $key => $value) {
    $attributes_string .= esc_attr($key) . '="' . esc_attr($value) . '" ';
}

?>

<button type="<?= esc_attr($type); ?>" class="<?= esc_attr($classes); ?>" <?= $attributes_string; ?>>
    <?= $slot; ?>
</button>