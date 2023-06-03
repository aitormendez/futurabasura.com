import domReady from '@roots/sage/client/dom-ready';

/**
 * Application entrypoint
 */
domReady(async () => {
  const mdMin = window.matchMedia('(min-width: 768px)');

  if (mdMin.matches && document.body.classList.contains('home')) {
    const { sliderHome } = await import('./sliderHome.js');
    sliderHome();
  }

  if (document.body.classList.contains('tax-artist')) {
    const { desplegarArtista } = await import('./shop.js');
    desplegarArtista();
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
