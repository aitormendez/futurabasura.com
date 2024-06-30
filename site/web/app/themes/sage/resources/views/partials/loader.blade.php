{{-- De momento no se usa hasta que haya más productos --}}
<div class="container">
  <div class="pb-5 row d-flex justify-content-center">
    {{-- ojo, .page-load-status tiene d-none y no se verá nunca. Es porque, en las páginas con pocas entradas, la navegación (previous-link) no se muestra y, en consecuencia, infinite-scroll no lo encuentra y no oculta el loader. Conviene eliminar el d-none cuando haya más entradas en los archivos de terms de texto --}}
    <div class="page-load-status px-sm-4 d-none">
      <div class="infinite-scroll-request">
        <div class="lds-ripple"><div></div><div></div></div>
      </div>
      <p class="infinite-scroll-last">{{ __('Fin del contenido', 'sage') }}</p>
      <p class="infinite-scroll-error">{{ __('No hay más páginas para cargar', 'sage') }}</p>
    </div>

    <div class="button-container d-none">
      <button class="view-more-button boton">{{ __('Ver más', 'sage') }}</button>
    </div>
  </div>
</div>
