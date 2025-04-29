import InfiniteScroll from 'infinite-scroll';

export function infiniteScrollShop() {
  const container = document.querySelector('.infinite-scroll-container');

  if (!container) {
    console.warn(
      '🚨 No se encontró el contenedor `.infinite-scroll-container`'
    );
    return;
  }

  new InfiniteScroll(container, {
    path: '.next',
    append: '.infinite-scroll-item',
    history: false,
    hideNav: '.woocommerce-pagination',
  });
}

export function infiniteScrollArchives() {
  new InfiniteScroll('.infinite-scroll-container', {
    path: '.nav-previous a',
    append: 'article',
    history: false,
    hideNav: '.posts-navigation',
    // button: '.view-more-button',
    // status: '.page-load-status',
  });
}
