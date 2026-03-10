import fs from 'fs-extra';
import path from 'path';
import fonter from 'fonter';
import ttf2woff2 from 'ttf2woff2';

import dotenv from "dotenv";
dotenv.config();

const SITE_NAME = process.env.SITE_NAME || "wp"; // .env или docker

const fontsDir = './assets/fonts';
const woffDir = path.join(fontsDir, 'WOFF2');
const fontFacesFile = './assets/src/scss/source/fonts.scss';

const italicRegex = /italic/i;

// Шаблон для @font-face
const fontFaceTemplate = (name, file, weight, style) => `@font-face {
  font-family: ${name};
  font-display: swap;
  src: url("/${SITE_NAME}/wp-content/themes/classic/assets/fonts/WOFF2/${file}.woff2") format("woff2");
  font-weight: ${weight};
  font-style: ${style};
}\n\n`;

// Конвертация OTF → TTF
async function otfToTtf() {
  await fs.ensureDir(fontsDir);
  const files = await fs.readdir(fontsDir);

  for (const file of files) {
    if (file.endsWith('.otf')) {
      const input = path.join(fontsDir, file);
      const output = path.join(fontsDir, file.replace('.otf', '.ttf'));
      const buffer = fs.readFileSync(input);
      const ttfBuffer = fonter({ formats: ['ttf'], buffer });
      fs.writeFileSync(output, ttfBuffer);
      console.log(` ${file} → TTF`);
    }
  }
}

// Конвертация TTF → WOFF2
async function ttfToWoff() {
  await fs.ensureDir(woffDir);
  const files = await fs.readdir(fontsDir);

  for (const file of files) {
    if (file.endsWith('.ttf')) {
      const input = path.join(fontsDir, file);
      const output = path.join(woffDir, file.replace('.ttf', '.woff2'));
      const buffer = fs.readFileSync(input);
      const woffBuffer = ttf2woff2(buffer);
      fs.writeFileSync(output, woffBuffer);
      console.log(` ${file} → WOFF2`);
    }
  }
}

// Генерация SCSS с правильными весами
async function fontStyle() {
  const fontFiles = await fs.readdir(woffDir);
  if (!fontFiles.length) {
    console.log('Нет WOFF2 файлов для генерации SCSS');
    return;
  }

  // Перезаписываем файл
  await fs.writeFile(fontFacesFile, '');
  const processedFonts = new Set();

  const parseFontFileName = (fileName) => {
    let name = fileName;
    let weight = 400;
    let style = 'normal';
    const lower = fileName.toLowerCase();

    if (italicRegex.test(lower)) style = 'italic';

    // точные совпадения через дефис
    if (/-ultrablack/i.test(fileName)) weight = 950;
    else if (/-extrablack/i.test(fileName)) weight = 950;
    else if (/-black/i.test(fileName)) weight = 900;
    else if (/-heavy/i.test(fileName)) weight = 900;
    else if (/-bold/i.test(fileName)) weight = 700;
    else if (/-semibold/i.test(fileName)) weight = 600;
    else if (/-demibold/i.test(fileName)) weight = 600;
    else if (/-medium/i.test(fileName)) weight = 500;
    else if (/-regular/i.test(fileName)) weight = 400;
    else if (/-light/i.test(fileName)) weight = 300;
    else if (/-thin/i.test(fileName)) weight = 100;
    else if (/-hairline/i.test(fileName)) weight = 100;
    else if (/-extralight/i.test(fileName)) weight = 200;
    else if (/-ultralight/i.test(fileName)) weight = 200;

    // имя шрифта до первого дефиса
    if (fileName.includes('-')) {
      name = fileName.split('-')[0];
    } else {
      name = fileName.replace(/[_\s]+/g, '');
    }

    name = name.replace(/[_\s]+/g, '');
    return { name, weight, style };
  };

  for (const file of fontFiles) {
    if (!file.endsWith('.woff2')) continue;
    const fileName = file.replace('.woff2', '');
    if (processedFonts.has(fileName)) continue;

    const { name, weight, style } = parseFontFileName(fileName);
    await fs.appendFile(fontFacesFile, fontFaceTemplate(name, fileName, weight, style));
    processedFonts.add(fileName);
  }

  console.log('fonts.scss перезаписан и обновлён!');
}

// Основной запуск
async function run() {
  await otfToTtf();
  await ttfToWoff();
  await fontStyle();
}

run();