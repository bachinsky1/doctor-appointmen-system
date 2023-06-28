const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        "./resources/js/**/*.html",
        "./resources/js/**/*.{vue,js,ts,jsx,tsx}",
        // "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                theme: colors.blue,
                danger: colors.red,
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("@tailwindcss/aspect-ratio"),
        // require("tw-elements/dist/plugin.cjs"),
        // require("flowbite/plugin"),
    ],
};
