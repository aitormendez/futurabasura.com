/* global fb */

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
    bioLink: '',
    bioLabel: '',
    init() {
      this.artists = fb.artists; // Asume que fb.artists incluye objetos con name y slug
      console.log(this.artists);
      const urlParams = new URLSearchParams(window.location.search);
      const artistSlug = urlParams.get('artist_filter');
      if (artistSlug) {
        const artist = this.artists.find((a) => a.slug === artistSlug);
        if (artist) {
          this.selectedSlug = artist.slug;
          this.selectedName = artist.name;
          // Configura bioLink y bioLabel si estamos en la tienda
          const isTaxonomyPage = window.location.pathname.includes('/artists/');
          if (!isTaxonomyPage) {
            this.bioLink = `${fb.homeUrl}/artists/${encodeURIComponent(
              artist.slug
            )}/`;
            this.bioLabel = `bio: ${artist.name}`;
          }
        } else {
          this.selectedName = 'Select an artist';
        }
      }
    },

    applyFilter(slug) {
      // Verificar si estamos en una página de taxonomía
      const isTaxonomyPage = window.location.pathname.includes('/artists/');

      // Construir la URL basada en si estamos o no en una página de taxonomía
      let newUrl;
      if (isTaxonomyPage) {
        // Si estamos viendo una taxonomía y se selecciona un artista, redirige a su página de taxonomía específica
        newUrl = `${fb.homeUrl}/artists/${encodeURIComponent(slug)}/`; // Usando slug para construir la URL
      } else {
        // Si estamos en la tienda, aplica el filtro y permanece en la tienda
        newUrl = slug
          ? `${fb.homeUrl}/shop/?artist_filter=${encodeURIComponent(slug)}`
          : `${fb.homeUrl}/shop/`;
      }

      // Redirige a la nueva URL
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
