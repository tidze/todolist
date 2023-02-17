/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                'Rubik': ['Rubik', 'sans-serif'],
                'Zeyada': ['Zeyada', 'cursive'],

            }
        },
        colors: {
            "customRed_1": "D90429"
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
