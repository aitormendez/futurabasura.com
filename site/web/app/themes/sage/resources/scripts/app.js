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
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
