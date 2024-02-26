/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./src/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                "poppins": ['Poppins', 'sans-serif']
            },
            colors: {
                'primary': '#4D8991',
                'secondary': '#2ED0E6',
                'tertiary': '#A37D60',
                'highlight': '#2A3D40',
                'contrast': '#673E70',
                'offwhite': '#FDFDFD',
            },
        },
    },
    plugins: [],
}
