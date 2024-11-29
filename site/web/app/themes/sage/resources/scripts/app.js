import domReady from '@roots/sage/client/dom-ready';
import { navigation } from './navigation.js';
import scramble from './scramble.js';
import './components/video/video-player.js';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import { gsap, random } from 'gsap';
Alpine.plugin(collapse);

/**
 * Application entrypoint
 */
domReady(async () => {
  const mdMin = window.matchMedia('(min-width: 768px)');

  gsap.set('#solapa', {
    opacity: 0,
  });

  gsap.set('#solapa li', {
    opacity: 0,
    rotate: () => (Math.random() - 0.5) * 2 * 600,
  });

  navigation();
  scramble();

  if (mdMin.matches && document.body.classList.contains('home')) {
    const { ajustarAltoCupones, sliderContenidos, destacadoRepetido } =
      await import('./frontPage.js');
    ajustarAltoCupones();
    sliderContenidos();
    destacadoRepetido();
  }

  if (document.body.classList.contains('home')) {
    const { sliderHome } = await import('./sliderHome.js');
    sliderHome();
  }

  if (document.body.classList.contains('page')) {
    const { marquee } = await import('./marquee.js');
    marquee();
  }

  if (
    document.body.classList.contains('post-type-archive-story') ||
    document.body.classList.contains('post-type-archive-project')
  ) {
    const { infiniteScrollArchives } = await import('./infiniteScroll.js');
    infiniteScrollArchives();
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
    const { anadirAlCarroSimple, resetearHiddenInput } = await import(
      './simpleProduct.js'
    );
    anadirAlCarroSimple();
    resetearHiddenInput();
  }

  if (document.body.classList.contains('simple')) {
    const { anadirAlCarroSimple, resetearHiddenInput } = await import(
      './simpleProduct.js'
    );
    anadirAlCarroSimple();
    resetearHiddenInput();
  }

  if (document.body.classList.contains('cart')) {
    const { carrito } = await import('./cart.js');
    carrito();
  }

  if (
    document.body.classList.contains('woocommerce-shop') ||
    document.body.classList.contains('tax-artist')
  ) {
    const { infiniteScrollShop } = await import('./infiniteScroll.js');
    infiniteScrollShop();
    const { dropdownFilter, dropdownSort } = await import('./shop.js');
    window.dropdownFilter = dropdownFilter;
    window.dropdownSort = dropdownSort;
  }

  if (
    document.body.classList.contains('single-story') ||
    document.body.classList.contains('single-project')
  ) {
    const { galeriaStory } = await import('./singleStory.js');
    galeriaStory();
  }

  window.Alpine = Alpine;
  Alpine.start();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
