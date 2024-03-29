import domReady from '@roots/sage/client/dom-ready';
import { navigation } from './navigation.js';
import Alpine from 'alpinejs';
import { dropdownFilter } from './shop.js';
window.Alpine = Alpine;
window.dropdownFilter = dropdownFilter;
Alpine.start();

/**
 * Application entrypoint
 */
domReady(async () => {
  const mdMin = window.matchMedia('(min-width: 768px)');

  navigation();

  if (mdMin.matches && document.body.classList.contains('home')) {
    const { sliderHome } = await import('./sliderHome.js');
    const { ajustarAltoCupones, sliderContenidos, destacadoRepetido } =
      await import('./frontPage.js');
    sliderHome();
    ajustarAltoCupones();
    sliderContenidos();
    destacadoRepetido();
  }

  if (document.body.classList.contains('tax-artist')) {
    const { desplegarArtista } = await import('./shop.js');
    desplegarArtista();
  }

  // if (document.body.classList.contains('post-type-archive-product')) {
  //   const { dropdownFilter } = await import('./shop.js');
  //   dropdownFilter();
  // }

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

  if (document.body.classList.contains('woocommerce-shop')) {
    const { infiniteScrollShop } = await import('./infiniteScroll.js');
    infiniteScrollShop();
  }

  if (
    document.body.classList.contains('single-story') ||
    document.body.classList.contains('single-project')
  ) {
    const { galeriaStory } = await import('./singleStory.js');
    galeriaStory();
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
