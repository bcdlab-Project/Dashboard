/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./app/Views/**/*.php"],
  theme: {
    extend: {
      borderRadius: {
        'corner': '1.5rem',
      },
      colors: {
        'bcdlab-b': '#3DFB81',
        'bcdlab-d': '#FF7245',
        'github': '#171515',
        'overlay': 'rgba(0, 0, 0, 0.5)',
      },
    },
  },
  plugins: [
    require("daisyui"),
    require('tailwind-scrollbar-hide')
  ],
}

