/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/sage/docs sage documentation}
 * @see {@link https://bud.js.org/learn/config bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */
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
    .assets(['images', 'svg']);

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
    .setUrl('http://localhost:3000')
    .setProxyUrl('https://futurabasura.test')
    .watch(['resources/views', 'app']);

  /**
   * Generate WordPress `theme.json`
   *
   * @note This overwrites `theme.json` on every build.
   *
   * @see {@link https://bud.js.org/extensions/sage/theme.json}
   * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
   */
  app.wpjson
    .setSettings({
      layout: {
        contentSize: '800px',
        wideSize: '1200px',
      },
      spacing: {
        margin: true,
        padding: true,
        blockGap: null,
        units: ['px', 'em', 'rem', 'vh', 'vw'],
        spacingSizes: [
          { name: 'Small', slug: 'small', size: '8px' },
          { name: 'Medium', slug: 'medium', size: '16px' },
          { name: 'Large', slug: 'large', size: '32px' },
        ],
      },
      background: {
        backgroundImage: true,
      },
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        duotone: [],
      },
      custom: {
        typography: {
          'font-size': {},
          'line-height': {},
        },
      },
      typography: {
        customFontSize: false,
      },
      alignWide: true,
      appearanceTools: true,
      border: {
        color: true,
        radius: true,
        style: true,
        width: true,
      },
      color: {
        link: true,
        palette: [
          {
            name: 'Black',
            slug: 'black',
            color: '#000000',
          },
          {
            name: 'White',
            slug: 'white',
            color: '#FFFFFF',
          },
        ],
      },
      spacing: {
        blockGap: true,
        margin: true,
        padding: true,
      },
      typography: {
        lineHeight: true,
      },
    })
    .useTailwindColors()
    .useTailwindFontFamily()
    .useTailwindFontSize()
    .enable();
};
