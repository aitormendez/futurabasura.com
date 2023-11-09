import InfiniteScroll from 'infinite-scroll';

export function infiniteScrollShop() {
  let main = new InfiniteScroll('.infinite-scroll-container', {
    path: '.page-numbers .next',
    append: '.infinite-scroll-item',
    history: false,
    hideNav: '.page-numbers',
    // button: '.view-more-button',
    // status: '.page-load-status',
  });
}
