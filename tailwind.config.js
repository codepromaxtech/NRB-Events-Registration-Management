import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
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
                    green: '#00793A',
                    'green-light': '#10b981',  // Medium green for accents
                    'green-pastel': '#d1fae5',  // Very light pastel green for backgrounds
                    'green-mint': '#ecfdf5',    // Ultra light mint for subtle backgrounds
                    red: '#EC1C24',
                },
            },
        },
    },

    plugins: [forms],
};
