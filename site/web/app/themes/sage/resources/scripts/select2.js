import 'select2';

export function inputsDropdown() {
  // esto sirve para sustituir los filtros (inputs dropdown) en archivo de producto

  let w = window.innerWidth,
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
}
