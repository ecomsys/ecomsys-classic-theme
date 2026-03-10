<?php

// render_component('ButtonLink', [
//     'variant' => 'success',
//     'slot' => 'Перейти',
//     'attrs' => ['href' => '/catalog']
// ]);

$variant = $variant ?? 'primary';
$slot = $slot ?? '';
$class = $class ?? '';
$attrs = $attrs ?? [];

$base_classes = 'inline-flex items-center justify-center rounded-lg font-medium transition duration-200 focus:outline-none';

$variants = [
    'primary' => 'bg-blue-600 text-white hover:bg-blue-700  disabled:opacity-60 disabled:hover:bg-blue-600 cursor-pointer disabled:cursor-not-allowed',
    'secondary' => 'bg-gray-600 text-white hover:bg-gray-700  disabled:opacity-60 disabled:hover:bg-gray-600 cursor-pointer disabled:cursor-not-allowed',
    'success' => 'bg-green-600 text-white hover:bg-green-700  disabled:opacity-60 disabled:hover:bg-green-600 cursor-pointer disabled:cursor-not-allowed',
    'danger' => 'bg-red-600 text-white hover:bg-red-700  disabled:opacity-60 disabled:hover:bg-red-600 cursor-pointer disabled:cursor-not-allowed',
];

$variant_classes = $variants[$variant] ?? $variants['primary'];

$classes = trim("$base_classes $variant_classes px-4 py-2 $class");

// Формируем строку атрибутов
$attributes_string = '';

foreach ($attrs as $key => $value) {
    $attributes_string .= esc_attr($key) . '="' . esc_attr($value) . '" ';
}

// В ButtonLink обязательно нужен href
$href = $attrs['href'] ?? '#';
unset($attrs['href']); // удаляем чтобы не дублировать

?>

<a href="<?= esc_url($href); ?>" class="<?= esc_attr($classes); ?>" <?= $attributes_string; ?>>
    <?= $slot; ?>
</a>