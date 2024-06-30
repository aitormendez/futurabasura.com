/**
 * @see {@link https://bud.js.org/extensions/bud-preset-wordpress/editor-integration/filters}
 */
roots.register.filters('@scripts/filters');

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);

/**
 * esta parte es para registrar el bloque sin Bud.
 */
// import { __ } from '@wordpress/i18n';
// import { registerBlockType } from '@wordpress/blocks';
// // Importa tu componente de edición personalizado
// import Edit from './blocks/edit-product';

// registerBlockType('sage/product', {
//   title: __('Product', 'sage'),
//   category: 'fb', // Asegúrate de que esta categoría está registrada
//   icon: 'smiley', // Cambia por tu icono SVG si es necesario
//   edit: Edit,
//   // La función save retorna null porque el renderizado se maneja en PHP
//   save: () => null,
// });

roots.register.blocks('@scripts/bud-blocks');
