/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/sage/docs sage documentation}
 * @see {@link https://bud.js.org/learn/config bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */

import tailwindConfig from './tailwind.config.mjs';

export default async (app) => {
  /**
   * Application assets & entrypoints
   *
   * @see {@link https://bud.js.org/reference/bud.entry}
   * @see {@link https://bud.js.org/reference/bud.assets}
   */
  app
    .entry('app', ['@scripts/app', '@styles/app'])
    .entry('editor', ['@scripts/editor', '@styles/editor'])
    .assets(['images']);

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/reference/bud.setPublicPath}
   */
  app.setPublicPath('/app/themes/sage/public/');

  /**
   * Development server settings
   *
   * @see {@link https://bud.js.org/reference/bud.setUrl}
   * @see {@link https://bud.js.org/reference/bud.setProxyUrl}
   * @see {@link https://bud.js.org/reference/bud.watch}
   */
  app
    .setUrl('http://localhost:3001')
    .setProxyUrl('https://futurabasura.test')
    .watch(['resources/views', 'app']);

  // .proxy('https://futurabasura.test')
  // .setUrl('http://0.0.0.0:3000')
  // .watch(['resources/views', 'app', 'resources/styles']);

  /**
   * Generate WordPress `theme.json`
   *
   * @note This overwrites `theme.json` on every build.
   *
   * @see {@link https://bud.js.org/extensions/sage/theme.json}
   * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
   */
  app.wpjson
    .useTailwindColors()
    .useTailwindFontFamily()
    .useTailwindFontSize()
    .setSettings({
      background: {
        backgroundImage: true,
      },
      color: {
        custom: true,
        customDuotone: false,
        customGradient: true,
        defaultDuotone: true,
        defaultGradients: true,
        defaultPalette: true,
        duotone: [],
      },
      custom: {
        spacing: {},
        typography: {
          'font-size': {},
          'line-height': {},
        },
      },
      spacing: {
        units: ['px', 'em', 'rem', 'vh', 'vw'],
        spacingSizes: [
          { name: 'Small', slug: 'small', size: '8px' },
          { name: 'Medium', slug: 'medium', size: '16px' },
          { name: 'Large', slug: 'large', size: '32px' },
        ],
        blockGap: true,
        margin: true,
        padding: true,
      },
      typography: {
        customFontSize: true,
        lineHeight: true,
      },
      appearanceTools: true,
      border: {
        color: true,
        radius: true,
        style: true,
        width: true,
      },
      layout: {
        contentSize: '800px',
        wideSize: '1200px',
      },
    })
    .setStyles({
      blocks: {
        'core/button': {
          color: {
            background: tailwindConfig.theme.colors.azul,
            text: `${tailwindConfig.theme.colors.white} !important`,
          },
        },
      },
    });
};
