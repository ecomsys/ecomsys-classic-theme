import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite'
import { fileURLToPath } from 'url'
import dotenv from 'dotenv';
import path from 'path'

dotenv.config();

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

export default defineConfig({
    base: '',

    resolve: {
        alias: {
            // для абсолютных импортов от корня темы
            "@": path.resolve(__dirname, './'),           
        }
    },

    plugins: [
        tailwindcss(),
    ],

    server: {
        open: process.env.SITE_URL || "http://localhost/wp",               // твой локальный WP
        host: 'localhost',                                               // откуда грузится vite
        port: 5173,                                                      // порт dev сервера
        strictPort: true,                                                // не прыгать на другой порт
        cors: true,                                                      // разрешаем WP грузить vite (иначе CORS ошибка)

        hmr: {
            host: 'localhost'    // hot reload (обновление без F5)
        },
    },

    // BUILD (npm run build)
    build: {
        outDir: 'assets/dist', // куда складывается билд
        emptyOutDir: true,     // очищать папку перед билдом
        manifest: true,        // создаёт manifest.json для WP

        rollupOptions: {
            // главный входной файл (из него тянется sass, tailwind, js)
            input: 'assets/src/js/main.js'
        }
    }
});