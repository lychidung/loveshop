import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'color-main': '#ff8fab',
                'color-main-2': '#F2D98D',
                'background-button': 'rgba(232,242,238,7%)',
                'boder-button': 'rgba(232,242,238,.2)',
                '#4361ee': '#4361ee',
                'button-file-blue': 'rgba(27, 85, 226, 0.239)',
                '#f1f2f3': '#f1f2f3',
            },
            spacing: {
                '50rem': '50rem',
                '32rem': '32rem',
                '37.5rem': '37.5rem',
                '30.5rem': '30.5rem',
            },
            borderWidth: {
                DEFAULT: '1px',
               '3': '3px',
              }
        },
    },

    plugins: [forms],
};
