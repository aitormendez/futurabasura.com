import InfiniteScroll from 'infinite-scroll';

export function infiniteScrollShop() {
  console.log('infiniteScrollShop');
  let main = new InfiniteScroll('.infinite-scroll-container', {
    path: '.next',
    append: '.infinite-scroll-item',
    history: false,
    hideNav: '.woocommerce-pagination',
    // button: '.view-more-button',
    // status: '.page-load-status',
  });
}
