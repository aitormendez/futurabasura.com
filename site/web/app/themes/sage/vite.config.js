import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { wordpressPlugin, wordpressThemeJson } from '@roots/vite-plugin';
import react from '@vitejs/plugin-react';
import path from 'path';
import fs from 'fs';

export default defineConfig({
  base: '/app/themes/sage/public/build/',
  plugins: [
    react(),
    tailwindcss(),
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/editor.css',
        'resources/js/editor.js',
      ],
      refresh: true,
    }),

    wordpressPlugin(),

    // Generate the theme.json file in the public/build/assets directory
    // based on the Tailwind config and the theme.json file from base theme folder
    wordpressThemeJson({
      disableTailwindColors: false,
      disableTailwindFonts: false,
      disableTailwindFontSizes: false,
    }),
  ],
  server: {
    watch: {
      usePolling: true,
      interval: 100, // Ajusta el intervalo de refresco si es necesario
    },
    fs: {
      strict: false,
    },
  },
  optimizeDeps: {
    include: [
      '@vidstack/react',
      '@radix-ui/react-tooltip',
      '@radix-ui/react-dismissable-layer',
      '@radix-ui/react-portal',
      '@radix-ui/react-popper',
      '@radix-ui/react-presence',
      '@radix-ui/react-dropdown-menu',
      '@radix-ui/react-menu',
      '@radix-ui/react-collection',
      '@radix-ui/react-focus-guards',
      '@radix-ui/react-focus-scope',
      '@radix-ui/react-roving-focus',
    ],
    esbuildOptions: {
      target: 'esnext',
    },
  },
  build: {
    watch: {
      include: [
        path.resolve(__dirname, '../../plugins/fb-blocks/src/**/*'), // Observa cambios en el plugin
        path.resolve(__dirname, '../../plugins/fb-blocks/build/**/*'),
      ],
    },
    commonjsOptions: {
      transformMixedEsModules: true,
    },
    rollupOptions: {
      output: {
        manualChunks(id) {
          if (id.includes('node_modules')) {
            if (id.includes('@vidstack')) {
              return 'vidstack'; // Separa Vidstack en su propio bundle
            }
            if (id.includes('@radix-ui')) {
              return 'radix-ui'; // Separa Radix UI en otro bundle
            }
            return 'vendor'; // Todo lo demás de node_modules
          }
        },
      },
    },
    chunkSizeWarningLimit: 700, // Opcional: ajusta el límite de tamaño
  },
  resolve: {
    alias: {
      '@scripts': '/resources/js',
      '@styles': '/resources/css',
      '@fonts': '/resources/fonts',
      '@images': '/resources/images',
    },
  },
});
