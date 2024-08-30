import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: {
        relative: true,
        files: [
            "./resources/views/**/*.blade.php",
            "./node_modules/flowbite/**/*.js",
            "./storage/framework/views/*.php",
            "./vendor/wire-elements/modal/resources/views/*.blade.php",
            "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php",
            "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        ],
    },
    safelist: [
        {
            pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
            variants: ["sm", "md", "lg", "xl", "2xl"],
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: "#EDF9FF",
                    100: "#d8f0ff",
                    200: "#b9e5ff",
                    300: "#89d7ff",
                    400: "#51bfff",
                    500: "#29a0ff",
                    600: "#1182ff",
                    700: "#0b68ea",
                    800: "#1053bd",
                    900: "#134892",
                    950: "#063970",
                },
                secondary: {
                    50: "#f9f9f9",
                    100: "#f3f3f3",
                    200: "#e6e6e6",
                    300: "#d9d9d9",
                    400: "#bfbfbf",
                    500: "#a6a6a6",
                    600: "#8c8c8c",
                    700: "#737373",
                    800: "#595959",
                    900: "#404040",
                },
                positive: "#0EB665",
            },
        },
    },

    plugins: [forms, require("flowbite/plugin")],
};
