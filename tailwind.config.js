/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
            },
        },
        extend: {
            fontFamily: {
                sans: ["Inter", "sans-serif"],
            },
            boxShadow: {
                square: "0px 25px 0px -10px",
            },
        },
    },
    plugins: [],
};
