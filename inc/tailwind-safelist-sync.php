<?php
/**
 * Скрипт для генерации Tailwind safelist с кешем
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключаем WordPress
require_once __DIR__ . '/../../../../wp-load.php';

global $wpdb;

// Пути
$tailwindDir = __DIR__ . '/../assets/src/tailwind/';
$safelistPath = $tailwindDir . 'tailwind.safelist.js';
$cacheFile = $tailwindDir . 'tailwind-safelist-cache.json';
$logFile = $tailwindDir . 'tailwind.log';

// --- логгер ---
function tw_log($message)
{
    global $logFile;

    $date = date('Y-m-d H:i:s');
    $line = "[{$date}] {$message}\n";

    file_put_contents($logFile, $line, FILE_APPEND);
}

// создаём папку если нет
if (!file_exists($tailwindDir)) {
    mkdir($tailwindDir, 0755, true);
}

$ttl = 1800; // 30 минут

// если кеш есть и он свежий — сразу выходим
if (file_exists($cacheFile)) {
    $age = time() - filemtime($cacheFile);

    if ($age < $ttl) {
        // ничего не делаем, чтобы не триггерить vite loop
        return;
    }
}

// Берем все посты
$posts = $wpdb->get_col("
SELECT post_content 
FROM {$wpdb->posts}
WHERE post_status = 'publish'
AND post_type IN ('post','page','wp_block')
");

if (!$posts) {
    tw_log("Постов не найдено");
    return;
}

// Парсим классы
$all_classes = [];

foreach ($posts as $html) {

    if (!is_string($html) || trim($html) === '') {
        continue;
    }
    if (strpos($html, 'class') === false && strpos($html, 'className') === false) {
        continue;
    }

    preg_match_all('/"className"\s*:\s*"([^"]+)"/i', $html, $matches1);
    preg_match_all('/"customClasses"\s*:\s*"([^"]+)"/i', $html, $matches2);
    preg_match_all('/class="([^"]+)"/i', $html, $matchesHtml);

    $matches = array_merge(
        $matches1[1] ?? [],
        $matches2[1] ?? [],
        $matchesHtml[1] ?? []
    );

    foreach ($matches as $classString) {

        $classes = preg_split('/\s+/', $classString);

        foreach ($classes as $c) {

            $c = trim($c);

            if ($c) {
                $all_classes[$c] = true;
            }
        }
    }
}

// Генерируем safelist
$unique_classes = array_keys($all_classes);
sort($unique_classes);

$safelistJs = "module.exports = [\n";

foreach ($unique_classes as $class) {
    $safelistJs .= "  '" . addslashes($class) . "',\n";
}
$safelistJs .= "];\n";

// если файл уже такой же — выходим
if (file_exists($safelistPath)) {

    $existing = file_get_contents($safelistPath);

    if ($existing === $safelistJs) {

        tw_log("Safelist не изменился — выход.");

        return;
    }
}

// Сохраняем файл
file_put_contents($safelistPath, $safelistJs);

// кеш
file_put_contents($cacheFile, json_encode([
    'classes' => $unique_classes,
    'js' => $safelistJs,
]));

tw_log("Safelist сгенерирован. Классов: " . count($unique_classes));
tw_log("Файл обновлен: " . $safelistPath);