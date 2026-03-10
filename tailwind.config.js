/*
// container — центрирование и отступы по брейкпоинтам.
// colors — два базовых цвета (можешь расширить).
// spacing — базовые спейсы для margin/padding.
// fontFamily — heading и body.
// fontSize — два основных размера: title и text.
// screens — стандартные Tailwind брейкпоинты.

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./**/*.php",
        "./assets/src/**/*.{js,ts,jsx,tsx,php}",        
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '10px',
                sm: '15px',
                lg: '30px',
                xl: '100px',
                '2xl': '150px',
            },
            center: true, // по центру страницы
        },       
        extend: {
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1280px',
                '2xl': '1536px',             
            },
            colors: {
                primary: '#1E3A8A', // пример синий
                secondary: '#F59E0B', // пример оранжевый
            },
            spacing: {
                '1': '4px',
                '2': '8px',
                '3': '12px',
                '4': '16px',
                '5': '20px',
                '6': '24px',
                '8': '32px',
                '10': '40px',
                '12': '48px',
                '16': '64px',
                '20': '80px',
            },
            fontFamily: {
                heading: ['Montserrat', 'sans-serif'],
                body: ['Roboto', 'sans-serif'],
            },
            fontSize: {
                'h1': ['48px', { lineHeight: '120%', fontWeight: '700' }],
                'h2': ['32px', { lineHeight: '120%', fontWeight: '700' }],
                'h3': ['24px', { lineHeight: '120%', fontWeight: '700' }],
                'h4': ['20px', { lineHeight: '120%', fontWeight: '700' }],
                'h5': ['18px', { lineHeight: '120%', fontWeight: '700' }],
                'h6': ['16px', { lineHeight: '120%', fontWeight: '700' }],
                'use': ['16px', { lineHeight: '150%', fontWeight: '400' }], 
            }
        },
    },
    plugins: [],
};
