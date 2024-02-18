/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./app/Views/**/*.php"],
  theme: {
    extend: {
      colors: {
        'bcdlab-b': '#3DFB81',
        'bcdlab-d': '#FF7245',
        'github': '#171515'
      },
    },
  },
  plugins: [
    require("daisyui"),
    require('tailwind-scrollbar-hide')
  ]
}

