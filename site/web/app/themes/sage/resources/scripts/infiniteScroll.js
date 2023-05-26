const InfiniteScroll = require('infinite-scroll');

$(() => {
  if (document.body.classList.contains('woocommerce-shop')) {

    let main = new InfiniteScroll( '.infinite-scroll-container', {
      path: '.page-numbers .next',
      append: '.infinite-scroll-item',
      history: false,
      hideNav: '.page-numbers',
      // button: '.view-more-button',
      // status: '.page-load-status',
    });


  }
});
