import Glide, {
  Controls,
  Autoplay,
  Keyboard,
  Breakpoints,
} from '@glidejs/glide/dist/glide.modular.esm.js';

export function singleProductGallery() {
  // galería de imágenes con Glide
  // ----------------------------------------------------
  const gallery = document.getElementById('glide');
  const indiceEl = document.getElementById('indice');

  if (!gallery || !indiceEl) {
    console.warn('singleProductGallery: elementos requeridos no encontrados');
    return;
  }

  const slides = Array.from(gallery.getElementsByClassName('slide')).filter(
    (slide) => !slide.classList.contains('glide__slide--clone')
  );

  if (slides.length === 0) {
    console.warn('singleProductGallery: sin slides reales');
    return;
  }

  const glide = new Glide('.g-gallery', {
    type: 'carousel',
    autoplay: false,
    animationDuration: 0,
    animationTimingFunc: 'linear',
    gap: 0,
  });

  function actualizarIndice() {
    try {
      indiceEl.innerHTML = `${glide.index + 1} / ${slides.length}`;
    } catch (e) {
      console.error('Error actualizando índice del slide:', e);
    }
  }

  glide.on('run', actualizarIndice);
  glide.on('mount.after', actualizarIndice);

  try {
    glide.mount({ Controls, Autoplay, Keyboard });
  } catch (e) {
    console.error('Fallo al montar Glide en galería de producto:', e);
    return;
  }

  gallery.addEventListener('click', () => {
    glide.go('>');
  });
}

export function sliderProductosRelacionadosArtista() {
  // galería de imágenes con Glide para productos relacionados
  // del mismo artista
  // ----------------------------------------------------

  const carousels = document.querySelectorAll('.g-by-artist');

  for (const carousel of carousels) {
    const track = carousel.querySelector('.glide__track');
    const slides = carousel.querySelectorAll('.glide__slide');

    if (!track || slides.length === 0) {
      console.warn('Carrusel de artista ignorado:', carousel);
      continue;
    }

    const glide = new Glide(carousel, {
      type: 'carousel',
      autoplay: 10,
      animationDuration: Math.floor(Math.random() * 10000 + 1000),
      animationTimingFunc: 'linear',
      perView: 6,
      breakpoints: {
        1280: { perView: 5 },
        1024: { perView: 4 },
        768: { perView: 3 },
        640: { perView: 2 },
      },
    });

    try {
      glide.mount({ Autoplay, Breakpoints });
    } catch (e) {
      console.error('Fallo al montar Glide en .g-by-artist:', carousel, e);
    }
  }
}

export function sliderProductosRelacionados() {
  // galería de imágenes con Glide para productos relacionados
  // ----------------------------------------------------

  const carousels = document.querySelectorAll('.g-related');

  for (const carousel of carousels) {
    const track = carousel.querySelector('.glide__track');
    const slides = carousel.querySelectorAll('.glide__slide');

    if (!track || slides.length === 0) {
      console.warn('Carousel ignorado por falta de slides:', carousel);
      continue;
    }

    const glide = new Glide(carousel, {
      type: 'carousel',
      autoplay: 10,
      animationDuration: Math.floor(Math.random() * 10000 + 1000),
      animationTimingFunc: 'linear',
      perView: 5,
      breakpoints: {
        1280: { perView: 5 },
        1024: { perView: 4 },
        768: { perView: 3 },
        640: { perView: 2 },
      },
    });

    try {
      glide.mount({ Autoplay, Breakpoints });
    } catch (e) {
      console.error('Fallo al montar Glide en .g-related:', carousel, e);
    }
  }
}
