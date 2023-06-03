import domReady from '@roots/sage/client/dom-ready';
import { navigation } from './navigation.js';

/**
 * Application entrypoint
 */
domReady(async () => {
  const mdMin = window.matchMedia('(min-width: 768px)');

  navigation();

  if (mdMin.matches && document.body.classList.contains('home')) {
    const { sliderHome } = await import('./sliderHome.js');
    sliderHome();
  }

  if (document.body.classList.contains('tax-artist')) {
    const { desplegarArtista } = await import('./shop.js');
    desplegarArtista();
  }

  if (document.body.classList.contains('post-type-archive-product')) {
    const { selectorArtista } = await import('./shop.js');
    selectorArtista();
  }

  if (
    document.body.classList.contains('post-type-archive-product') ||
    document.body.classList.contains('tax-artist')
  ) {
    const { inputsDropdown } = await import('./select2.js');
    inputsDropdown();
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
