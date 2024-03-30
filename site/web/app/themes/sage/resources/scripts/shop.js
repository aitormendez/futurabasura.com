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
      const artistSlug = urlParams.get('artist_filter'); // Asegúrate de que este parámetro coincida con el nombre que usas en la URL
      if (artistSlug) {
        const artist = this.artists.find((a) => a.slug === artistSlug);
        if (artist) {
          this.selectedSlug = artist.slug;
          this.selectedName = artist.name;
        } else {
          // Si el slug está presente pero no coincide con ningún artista, muestra texto predeterminado
          this.selectedName = 'Select an artist';
        }
      }
    },

    applyFilter(slug) {
      // Verificar si estamos en una página de taxonomía
      const isTaxonomyPage = window.location.pathname.includes('/artists/');

      // Construir la URL basada en si estamos o no en una página de taxonomía
      const baseUrl = isTaxonomyPage
        ? `${fb.homeUrl}/artists/`
        : `${fb.homeUrl}/shop/?artist_filter=`;
      const newUrl = slug ? `${baseUrl}${encodeURIComponent(slug)}` : baseUrl;

      window.location.href = newUrl;
    },
  };
}

export const dropdownSort = () => {
  return {
    open: false,
    selected: 'Sorting by',
    options: [
      { value: '', text: 'Default sorting' },
      { value: 'date', text: 'Latest' },
      { value: 'price', text: 'Price: low to high' },
      { value: 'price-desc', text: 'Price: high to low' },
    ],
    init() {
      // Establecer el criterio de ordenación seleccionado basado en la URL, si existe
      const urlParams = new URLSearchParams(window.location.search);
      const orderByValue = urlParams.get('orderby') || '';

      // Buscar la opción correspondiente
      const selectedOption = this.options.find(
        (option) => option.value === orderByValue
      );
      if (selectedOption) {
        this.selected = selectedOption.text;
      }
    },
    applySort(sortValue) {
      const url = new URL(window.location);
      url.searchParams.set('orderby', sortValue);
      window.location.href = url.href;
    },
  };
};
