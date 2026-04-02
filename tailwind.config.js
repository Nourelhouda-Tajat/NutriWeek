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
                    olive: "#7A8C54", // Le vert de ton bouton "Get Started"
                    olive_dark: "#5D6B40",
                    olive_light: "#EDF1E5", // Le fond des petites cartes
                    text_dark: "#1A1A1A",
                    text_light: "#707070",
                    bg_page: "#F9FAF6", // Le fond très légèrement grisé/vert de la maquette
                    green_subtle: "#3C645B", // Le vert du logo NutriWeek
                },
            },
        },
    },
    plugins: [],
};