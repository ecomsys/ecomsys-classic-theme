import sharp from "sharp";
import fs from "fs-extra";
import path from "path";
import pngToIco from "png-to-ico";
import dotenv from 'dotenv';
dotenv.config();

const rootDir = process.cwd(); // корень проекта
const sourceDir = path.join(rootDir, "assets/favicons/source");
const outputDir = path.join(rootDir, "assets/favicons");

// Создаём папку output
await fs.ensureDir(outputDir);

// Берём первый SVG/PNG из source
const files = await fs.readdir(sourceDir);
if (!files.length) {
  console.log("Нет исходников в assets/favicons/source");
  process.exit();
}

const sourceFile = path.join(sourceDir, files[0]);
console.log("Используем исходник:", sourceFile);

// Настройки размеров
const sizes = {
  favicon16: 16,
  favicon32: 32,
  appleTouch: 180,
  android192: 192,
  android512: 512
};

// Файлы для генерации PNG
const pngOutputs = [
  { name: "favicon-16x16.png", size: sizes.favicon16 },
  { name: "favicon-32x32.png", size: sizes.favicon32 },
  { name: "apple-touch-icon.png", size: sizes.appleTouch },
  { name: "android-chrome-192x192.png", size: sizes.android192 },
  { name: "android-chrome-512x512.png", size: sizes.android512 }
];

// Генерация PNG
for (const item of pngOutputs) {
  const outputPath = path.join(outputDir, item.name);
  await sharp(sourceFile)
    .resize(item.size, item.size, { fit: "contain", background: { r: 0, g: 0, b: 0, alpha: 0 } })
    .png({ quality: 90 })
    .toFile(outputPath);
  console.log(`✔ ${item.name} (${item.size}x${item.size})`);
}

// Генерация favicon.ico (16, 32)
const icoFiles = [
  path.join(outputDir, "favicon-16x16.png"),
  path.join(outputDir, "favicon-32x32.png")
];

const icoOutput = path.join(outputDir, "favicon.ico");
const icoBuffer = await pngToIco(icoFiles);
await fs.writeFile(icoOutput, icoBuffer);
console.log("✔ favicon.ico");

const siteName = process.env.SITE_NAME || "Ecomsys Classic Theme (Tailwind + Hot Reload)";
const shortName = process.env.SITE_SHORT_NAME || "Classic Theme";

// Генерация site.webmanifest
const manifest = {
  name: siteName,
  short_name: shortName,
  icons: [
    {
      src: "android-chrome-192x192.png",
      sizes: "192x192",
      type: "image/png"
    },
    {
      src: "android-chrome-512x512.png",
      sizes: "512x512",
      type: "image/png"
    }
  ],
  start_url: "/",
  display: "standalone",
  background_color: "#ffffff",
  theme_color: "#ffffff"
};

await fs.writeJSON(path.join(outputDir, "site.webmanifest"), manifest, { spaces: 2 });
console.log("✔ site.webmanifest");

console.log("\nFavicons и PWA icons готовы! Все файлы в assets/favicons");

// ---- Вставка или обновление блока фавиконок в header.php ----
const headerFile = path.join(rootDir, "header.php");

if (await fs.pathExists(headerFile)) {
  let headerContent = await fs.readFile(headerFile, "utf-8");

  const faviconLinks = `
<!-- Favicon и PWA icons -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/site.webmanifest">
<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!-- /Favicon и PWA icons -->
`;

  // Регулярка для поиска старого блока
  const faviconBlockRegex = /<!-- Favicon и PWA icons -->[\s\S]*?<!-- \/Favicon и PWA icons -->/i;

  if (faviconBlockRegex.test(headerContent)) {
    // Если блок есть — заменяем его новым
    headerContent = headerContent.replace(faviconBlockRegex, faviconLinks.trim());
    console.log("♻ Старый блок фавиконок заменён новым");
  } else {
    // Если блока нет — вставляем перед wp_head()
    headerContent = headerContent.replace(/<\?php\s*wp_head\(\s*\);\s*\?>/i, `${faviconLinks}\n<?php wp_head(); ?>`);
    console.log("✔ Блок фавиконок добавлен перед wp_head()");
  }

  await fs.writeFile(headerFile, headerContent, "utf-8");
} else {
  console.log("⚠ header.php не найден в корне проекта");
}

// ---- Очистка кешей ----
const viteCache = path.join(rootDir, "node_modules/.vite");
const distDir = path.join(rootDir, "dist");
const buildDir = path.join(rootDir, "build");

if (await fs.pathExists(viteCache)) {
  await fs.remove(viteCache);
  console.log(" Очищен Vite cache");
}

if (await fs.pathExists(distDir)) {
  await fs.remove(distDir);
  console.log(" Очищен dist");
}

if (await fs.pathExists(buildDir)) {
  await fs.remove(buildDir);
  console.log(" Очищен build");
}

