$(() => {

  if (document.body.classList.contains('tax-artist')) {
    // desplegable descripción artista
    // https://codepen.io/brundolf/pen/dvoGyw
    // ------------------------------------------------------------------------------

    function collapseSection(element) {
      var sectionHeight = element.scrollHeight;

      var elementTransition = element.style.transition;
      element.style.transition = '';

      requestAnimationFrame(function () {
        element.style.height = '3.8rem';
        element.style.transition = elementTransition;

        requestAnimationFrame(function () {
          element.style.height = sectionHeight + 'px';
        });
      });

      element.setAttribute('data-collapsed', 'true');
    }

    function expandSection(element) {

      element.style.height = '3.8rem';

      element.addEventListener('transitionend', function (e) {
        element.removeEventListener('transitionend', arguments.callee);

        element.style.height = null;
      });

      element.setAttribute('data-collapsed', 'false');
    }

    document.querySelector('#toggle-button').addEventListener('click', function (e) {
      var section = document.querySelector('.section.collapsible');
      var isCollapsed = section.getAttribute('data-collapsed') === 'true';

      if (isCollapsed) {
        expandSection(section)
        section.setAttribute('data-collapsed', 'false')
      } else {
        collapseSection(section)
      }
    });
  }


  if (document.body.classList.contains('post-type-archive-product')) {

    var select = '.dropdown_artist';

    function onProductTaxChange() {
      if ($(select).val() !== '') {
        location.href = fb.homeUrl + '/artists/' + $(select).val();
        // location.href = fb.homeUrl+ '/shop?&artist='+$(select).val();
      } else {
        location.href = fb.homeUrl + '/shop/';
      }
    }
    $(select).change(onProductTaxChange);

  }
});
