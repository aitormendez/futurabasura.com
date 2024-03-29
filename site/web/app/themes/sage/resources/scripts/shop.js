export function selectorArtista() {
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

export function dropdownFilter() {
  return {
    open: false,
    selectedSlug: '',
    selectedName: '',
    artists: [],
    init() {
      this.artists = fb.artists; // Asume que fb.artists incluye objetos con name y slug
      // Establece el artista seleccionado basado en la URL, si existe
      const urlParams = new URLSearchParams(window.location.search);
      const artistSlug = urlParams.get('filtro_artist');
      if (artistSlug) {
        const artist = this.artists.find((a) => a.slug === artistSlug);
        if (artist) {
          this.selectedSlug = artist.slug;
          this.selectedName = artist.name;
        }
      }
    },
    applyFilter(slug) {
      this.selectedSlug = slug;
      const artist = this.artists.find((a) => a.slug === slug);
      this.selectedName = artist ? artist.name : '';
      this.open = false;
      // Actualiza la URL con el filtro seleccionado o elimina el filtro si se seleccionó "All artists"
      const newUrl = slug
        ? `${fb.homeUrl}/shop/?artist_filter=${encodeURIComponent(slug)}`
        : `${fb.homeUrl}/shop/`;
      window.location.href = newUrl;
    },
  };
}

export const dropdownSort = () => {
  return {
    open: false,
    selected: 'Sorting by',
    options: [
      { value: 'default', text: 'Default sorting' },
      { value: 'date', text: 'Latest' },
      { value: 'price', text: 'Price: low to hight' },
      { value: 'price-desc', text: 'Price: hight to low' },
    ],
    fetchOptions() {
      // Opcional: Aquí puedes dinámicamente buscar las opciones si son generadas por el backend o configurarlas manualmente como arriba.
    },
    applySort(sortValue) {
      const url = new URL(window.location);
      url.searchParams.set('orderby', sortValue);
      window.location = url.href;
    },
  };
};
