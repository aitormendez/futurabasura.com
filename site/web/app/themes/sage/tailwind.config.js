/** @type {import('tailwindcss').Config} config */
const config = {
  content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    fill: (theme) => ({
      red: theme('colors.red.600'),
      'allo-claro': theme('colors.allo-claro'),
    }),
    extend: {
      colors: {}, // Extend Tailwind's default colors
    },
  },
  plugins: [],
};

export default config;
