import InfiniteScroll from 'infinite-scroll';

export function infiniteScrollShop() {
  new InfiniteScroll('.infinite-scroll-container', {
    path: '.next',
    append: '.infinite-scroll-item',
    history: false,
    hideNav: '.woocommerce-pagination',
    // button: '.view-more-button',
    // status: '.page-load-status',
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
