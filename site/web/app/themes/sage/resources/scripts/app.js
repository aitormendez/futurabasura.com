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

  if (document.body.classList.contains('single-product')) {
    const { singleProductGallery } = await import('./singleProduct.js');
    const { sliderProductosRelacionadosArtista } = await import(
      './singleProduct.js'
    );
    const { sliderProductosRelacionados } = await import('./singleProduct.js');
    singleProductGallery();
    sliderProductosRelacionadosArtista();
    sliderProductosRelacionados();
  }

  if (document.body.classList.contains('variable')) {
    const { anadirAlCarroVariable } = await import('./variableProduct.js');
    anadirAlCarroVariable();
  }

  if (document.body.classList.contains('simple')) {
    const { anadirAlCarroSimple } = await import('./simpleProduct.js');
    anadirAlCarroSimple();
  }

  if (document.body.classList.contains('cart')) {
    const { carrito } = await import('./cart.js');
    carrito();
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
