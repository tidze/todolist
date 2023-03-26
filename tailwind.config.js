/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'Rubik': ['Rubik', 'sans-serif'],
                'Zeyada': ['Zeyada', 'cursive'],
            }
        },
    },
    plugins: [
        // require('prettier-plugin-tailwindcss')
    ],
}
