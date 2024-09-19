import Glide, {
  Controls,
  Autoplay,
  Keyboard,
  Breakpoints,
} from '@glidejs/glide/dist/glide.modular.esm.js';

export function singleProductGallery() {
  // galería de imágenes con Glide
  // ----------------------------------------------------
  let g = document.getElementById('glide'),
    s = g.getElementsByClassName('slide'),
    slidesReales = Array.from(s).filter(
      (slide) => !slide.classList.contains('glide__slide--clone'),
    ),
    i = document.getElementById('indice');

  var glide = new Glide('.g-gallery', {
    type: 'carousel',
    autoplay: false,
    animationDuration: 0,
    animationTimingFunc: 'linear',
    gap: 0,
  });

  glide.on('run', function () {
    indice();
  });

  glide.on('mount.before', function () {
    indice();
  });

  glide.mount({
    Controls,
    Autoplay,
    Keyboard,
  });

  function indice() {
    i.innerHTML = glide.index + 1 + ' / ' + slidesReales.length;
  }

  function avanza() {
    glide.go('>');
  }

  g.addEventListener('click', avanza);
}

export function sliderProductosRelacionadosArtista() {
  // galería de imágenes con Glide para productos relacionados
  // del mismo artista
  // ----------------------------------------------------

  let slidesA = document.getElementsByClassName('g-by-artist');

  for (const c of slidesA) {
    let gid = '#' + c.id;
    let dur = Math.floor(Math.random() * 10000 + 1000);

    new Glide(gid, {
      type: 'carousel',
      autoplay: 10,
      animationDuration: dur,
      animationTimingFunc: 'linear',
      perView: 6,
      breakpoints: {
        1280: {
          perView: 5,
        },
        1024: {
          perView: 4,
        },
        768: {
          perView: 3,
        },
        640: {
          perView: 2,
        },
      },
    }).mount({
      Autoplay,
      Breakpoints,
    });
  }
}

export function sliderProductosRelacionados() {
  // galería de imágenes con Glide para productos relacionados
  // ----------------------------------------------------

  let slides = document.getElementsByClassName('g-related');

  for (const c of slides) {
    let list = '.g-related-' + c.classList;
    let clase = '.' + list.split(' ').slice(2).toString();
    let dur = Math.floor(Math.random() * 10000 + 1000);

    new Glide(clase, {
      type: 'carousel',
      autoplay: 10,
      animationDuration: dur,
      animationTimingFunc: 'linear',
      perView: 5,
      breakpoints: {
        1280: {
          perView: 5,
        },
        1024: {
          perView: 4,
        },
        768: {
          perView: 3,
        },
        640: {
          perView: 2,
        },
      },
    }).mount({
      Autoplay,
      Breakpoints,
    });
  }
}
