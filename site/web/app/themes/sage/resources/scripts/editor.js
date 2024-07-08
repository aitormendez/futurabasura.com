import { registerBlockCollection } from '@wordpress/blocks';

/**
 * @see {@link https://bud.js.org/extensions/bud-preset-wordpress/editor-integration/filters}
 */
roots.register.filters('@scripts/filters');

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);

roots.register.blocks('@scripts/bud-blocks');

registerBlockCollection('fb', {
  title: 'Futura Basura',
  icon: 'star-filled',
});
