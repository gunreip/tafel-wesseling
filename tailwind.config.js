Ks// /home/gunreip/code/tafel-wesseling/tailwind.config.js

import forms from "@tailwindcss/forms";
import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.{js,ts,vue}",
  ],
  theme: { extend: {} },
  plugins: [forms, daisyui],
  daisyui: {
    themes: ["corporate", "emerald", "light"],
    styled: true,
    base: true,
    utils: true,
    logs: false,
  },
};