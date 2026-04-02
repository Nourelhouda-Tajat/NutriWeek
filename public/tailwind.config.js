/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                garden: {
                    olive: "#7A8C54",
                    olive_dark: "#5D6B40",
                    olive_light: "#EDF1E5",
                    text_dark: "#1A1A1A",
                    text_light: "#707070",
                    bg_page: "#F9FAF6",
                    beige_bg: "#FBF9F1",
                    orange_accent: "#E69E57",
                },
            },
        },
    },
    plugins: [],
};