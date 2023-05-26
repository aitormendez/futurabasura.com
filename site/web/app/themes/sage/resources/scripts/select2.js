import 'select2';

// esto sirve para sustituir los filtros (inputs dropdown) en archivo de producto
$(() => {
  if (document.body.classList.contains('post-type-archive-product') || document.body.classList.contains('tax-artist')) {
    let
    w = window.innerWidth,
    selectWidth = '';

  if (w < 791) {
    selectWidth = '80vw';
  } else {
    selectWidth = '35vw';
  }

  $('.dropdown_artist, .orderby').select2({
    minimumResultsForSearch: -1,
    width: selectWidth,
    // templateResult: formatState,
    // dropdownParent: $('#desplegable'),
  });
  }
});


// function formatState (state) {
//   if (!state.id) {
//     return state.text;
//   }
//   var baseUrl = "/user/pages/images/flags";
//   var $state = $(
//     '<span class="">' + state.text + '</span>'
//   );
//   return $state;
// };
