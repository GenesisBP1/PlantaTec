import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50:  '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',   // verde principal
                    600: '#16a34a',   // el que más uses
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                earth: {
                    50:  '#fdf8f0',
                    100: '#faefd8',
                    200: '#f3d9a4',
                    300: '#e9bb6a',
                    400: '#dda03a',   // tono tierra cálido
                    500: '#c8851c',
                    600: '#a86614',
                },
            },
        },
    },
    plugins: [forms],
};