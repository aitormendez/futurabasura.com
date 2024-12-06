import typography from '@tailwindcss/typography';
import plugin from 'tailwindcss/plugin.js';

/** @type {import('tailwindcss').Config} config */
const config = {
  content: [
    './index.php',
    './app/**/*.php',
    './resources/**/*.{php,vue,js,jsx,ts,tsx}',
  ],
  theme: {
    fill: (theme) => ({
      red: theme('colors.red.600'),
    }),
    extend: {
      fill: (theme) => ({
        rojo: theme('colors.rojo'),
      }),
      boxShadow: {
        abajo: '0 10px 10px -10px rgba(0, 0, 0, 0.5)',
      },
      borderRadius: {
        elipse: '50%',
      },
      typography: ({ theme }) => ({
        fb: {
          css: {
            '--tw-prose-links': theme('colors.azul'),
            'h1, h2, h3, h4, h5, h6': {
              lineHeight: '1.3',
            },
          },
        },
        DEFAULT: {
          css: {
            fontFamily: theme('fontFamily.serif').join(', '),
            lineHeight: '1.2',
            maxWidth: 'auto,',
            color: '#000',
            'a:link': {
              'text-decoration': 'none',
              color: '#0000ff',
              '&:hover': {
                color: '#000',
              },
            },
            'h1, h2, h3, h4, h5, h6': {
              lineHeight: '1.3',
            },
          },
        },
      }),
      letterSpacing: {
        max: '.25em',
      },
      fontFamily: {
        sans: ['arial', 'sans-serif'],
        serif: ['times-new-roman', 'times', 'serif'],
        bugrino: ['Bugrino', 'sans-serif'],
        fk: ['FK Display', 'sans-serif'],
        arialblack: ['ArialBlack', 'sans-serif'],
      },
      backgroundImage: (theme) => ({
        fondo: "url('../images/bg.svg')",
        'tk-triangulo': "url('../images/triangulo-ticket.svg')",
        'tk-triangulo-down': "url('../images/triangulo-ticket-down.svg')",
        'fondo-claro': "url('../images/bg-claro.svg')",
        'fondo-medio': "url('../images/bg-medio.svg')",
        punteado: "url('../images/punteado-cupon.svg')",
      }),
      backgroundSize: {
        auto: 'auto',
        cover: 'cover',
        contain: 'contain',
        // puedes agregar más tamaños personalizados si lo necesitas
        '50%': '50%',
        '10px': '10px',
      },
    },
    colors: {
      'negro-fb': '#3e2b2f',
      'gris-fb': '#ada3a4',
      'gris-claro-fb': '#dfd1d2',
      allo: '#ffff00',
      'allo-claro': '#dbffe9',
      azul: '#0000ff',
      'azul-claro': '#00ffff',
      rojo: '#af0000',
      transparent: 'transparent',
      white: 'white',
      black: 'black',
      'media-brand': 'rgb(var(--media-brand) / <alpha-value>)',
      'media-focus': 'rgb(var(--media-focus) / <alpha-value>)',
    },
  },
  variants: {
    extend: {
      opacity: ['hover', 'focus', 'group-hover'],
      borderWidth: ['last'],
    },
  },
  plugins: [
    typography,
    plugin(function ({ addComponents }) {
      const textos = {
        '.sombra': {
          textShadow: '0.1em 0.1em 0 #000',
          textTransform: 'uppercase',
          letterSpacing: '0.2em',
          lineHeight: '1em',
          color: '#fff',
        },
        '.nav-item': {
          textShadow: '0.1em 0.1em 0 #000',
          textTransform: 'uppercase',
          fontSize: '1.5rem',
          letterSpacing: '0.2em',
          lineHeight: '1em',
          color: '#fff',
        },
        '.page-header-font': {
          fontFamily: '"Times New Roman", Times, serif',
          fontSize: '3rem',
          letterSpacing: '-0.03em',
          color: '#3e2b2f',
        },
      };
      const botones = {
        '.btn': {
          fontFamily: 'arial, sans-serif',
          border: '1px solid #000',
          backgroundColor: '#fff',
          textTransform: 'uppercase',
          letterSpacing: '0.2em',
          fontWeight: 'bold',
          fontSize: '0.8rem',
          color: '#000',
          padding: '0.7em 1em 0.6em',
        },
        '.btn-cart': {
          backgroundColor: '#0000ff',
          letterSpacing: '0.05em',
          textAlign: 'center',
          padding: '1em 1.5em',
          textTransform: 'uppercase',
          color: '#fff',
        },
      };
      addComponents([textos, botones]);
    }),
    plugin(function ({ addUtilities }) {
      const newUtilities = {
        '.clip-path-elipse': {
          clipPath: 'ellipse(50% 50% at 50% 50%)',
        },
        '.text-shadow': {
          textShadow: '0.1em 0.1em 0 #000',
        },
      };
      addUtilities(newUtilities, ['responsive', 'hover']);
    }),
  ],
};

export default config;
