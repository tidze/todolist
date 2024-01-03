const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                tokhmi: ['kiri','monospace'],
                custom: ['YourFont', 'sans-serif'],
                'rdodle': 'Rubik Doodle Triangles',
                // digital_display: ['digital_display', 'sans-serif'],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
