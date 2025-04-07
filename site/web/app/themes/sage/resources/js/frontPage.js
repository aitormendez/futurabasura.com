import Glide, {
  Controls,
  Autoplay,
  Keyboard,
} from '@glidejs/glide/dist/glide.modular.esm.js';
import { gsap } from 'gsap';
// import anime from 'animejs';
// import Plyr from 'plyr';

export function ajustarAltoCupones() {
  // ajustar alto cupones
  // ----------------------------------------------------

  let cupones = document.getElementsByClassName('cupon-wrap');

  for (const c of cupones) {
    let altoOrg = c.offsetHeight;
    let alto = Math.ceil(altoOrg / 12) * 12;
    c.style.height = alto + 'px';
  }
}

export function sliderContenidos() {
  // slider de contenidos (no el principal de productos)
  // ----------------------------------------------------

  let gals = document.querySelectorAll('.galeria .glide');

  for (let i = 0; i < gals.length; i++) {
    gals[i].id = 'gal' + i;

    new Glide('#gal' + i, {
      type: 'carousel',
      autoplay: 2000,
      animationDuration: 1000,
      animationTimingFunc: 'linear',
      gap: 0,
    }).mount({
      Controls,
      Autoplay,
      Keyboard,
    });
  }
}

export function destacadoRepetido() {
  // Ajustar alto de contenido con formato "repetido"
  // ------------------------------------------------

  const repetidos = document.querySelectorAll('.repeticion');

  repetidos.forEach((element) => {
    const img = element.querySelector('img');
    const clip = element.querySelector('.clip');

    if (img && clip) {
      const alto = img.clientHeight;
      clip.style.height = `${alto}px`;
    }
  });

  // Animación título de contenido con formato "repetido"
  // -----------------------------------------------------

  const titulos = document.querySelectorAll('.title-repetido');

  titulos.forEach((element) => {
    element.addEventListener('mouseover', () => {
      const randX = Math.floor(Math.random() * 100 - 50);
      const randY = Math.floor(Math.random() * 100 - 50);
      const rotate = Math.floor(Math.random() * 360 - 180);

      gsap.to(element, {
        x: randX,
        y: randY,
        rotation: rotate,
        duration: 1,
        ease: 'power2.out',
      });
    });
  });
}
