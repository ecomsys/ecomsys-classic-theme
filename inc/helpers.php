<?php
// --------------------------------------------------------------------------------------------------------------------------------
// SVG SPRITE
// ---------------------------------------------------------------------------------------------------------------------------------
/**
 * Возвращает SVG иконку из спрайта темы.
 *
 * @param string $icon_id ID иконки в спрайте (например, 'burger')
 * @param string $classes CSS классы для SVG (Tailwind или свои)
 * @return void
 */
function svg_icon($icon_id, $classes = '')
{
    // Путь к спрайту темы
    $sprite_url = get_template_directory_uri() . '/assets/icons/sprite/sprite.svg';

    echo '<svg class="' . esc_attr($classes) . '">';
    echo '<use href="' . esc_url($sprite_url) . '#' . esc_attr($icon_id) . '"></use>';
    echo '</svg>';
}


// --------------------------------------------------------------------------------------------------------------------------------
// RENDER COMPONENT
// ---------------------------------------------------------------------------------------------------------------------------------

/**
 * Рендер компонента с авто-выводом
 *
 * @param string $name Имя компонента с группой, например: "UI.Button"
 * @param array  $data Данные для компонента
 * @return void
 */
function render_component($name, $data = [])
{
    if (!$name) return;

    $parts = explode('.', $name);
    if (count($parts) < 2) return;

    $category = $parts[0];
    $component = $parts[1];

    // Варианты пути
    $paths = [        
        __DIR__ . "/../components/{$category}/{$component}/render/index.php",        
        __DIR__ . "/../components/{$category}/{$component}/index.php",
    ];

    $found = false;
    foreach ($paths as $path) {
        if (file_exists($path)) {
            $found = $path;
            break;
        }
    }

    if (!$found) return;

    if (!empty($data) && is_array($data)) {
        extract($data, EXTR_SKIP);
    }

    ob_start();
    try {
        require $found;
    } catch (Throwable $e) {
        ob_end_clean();
        return;
    }

    echo ob_get_clean();
}

// --------------------------------------------------------------------------------------------------------------------------------
// FAVICON
// ---------------------------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------
// Убираем Site Icon из кастомайзера
// ---------------------------------------------------
add_action('customize_register', function ($wp_customize) {
    $wp_customize->remove_setting('site_icon');
    $wp_customize->remove_control('site_icon');
});

// ---------------------------------------------------
// Полное отключение favicon WordPress
// ---------------------------------------------------
add_action('init', function () {

    // убираем вывод WP favicon
    remove_action('wp_head', 'wp_site_icon', 99);
    remove_action('admin_head', 'wp_site_icon');
    remove_action('login_head', 'wp_site_icon');

    // убираем поддержку theme favicon
    remove_theme_support('site-icon');

    // удаляем из базы если вдруг осталась
    if (get_option('site_icon')) {
        delete_option('site_icon');
    }
});

// ---------------------------------------------------
// Кастомная favicon для админки и логина
// ---------------------------------------------------
add_action('admin_head', 'theme_custom_favicon');
add_action('login_head', 'theme_custom_favicon');

function theme_custom_favicon()
{
    $uri = get_template_directory_uri() . '/assets/favicons/';
    ?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $uri; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $uri; ?>favicon-16x16.png">
    <?php
}


