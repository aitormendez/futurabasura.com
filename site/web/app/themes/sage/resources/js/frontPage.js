import Glide, {
  Controls,
  Autoplay,
  Keyboard,
} from '@glidejs/glide/dist/glide.modular.esm.js';
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
  // ajustar alto de contenido con formato "repetido"
  // ----------------------------------------------------

  let repetidos = document.querySelectorAll('.repeticion');
  repetidos.forEach(function (element) {
    // Encontrar la primera imagen dentro del elemento actual
    let img = element.querySelector('img');

    // Encontrar el primer elemento con la clase 'clip' dentro del elemento actual
    let clip = element.querySelector('.clip');

    if (img && clip) {
      // Obtener la altura de la imagen
      let alto = img.clientHeight;

      // Establecer la altura del elemento 'clip' igual a la altura de la imagen
      clip.style.height = alto + 'px';
    }
  });

  // Animación título de contenido con formato "repetido"
  // ----------------------------------------------------

  let titulos = document.getElementsByClassName('title-repetido');

  for (let i = 0; i < titulos.length; i++) {
    const element = titulos[i];
    element.addEventListener('mouseover', function () {
      let randX = Math.floor(Math.random() * 100 - 50);
      let randY = Math.floor(Math.random() * 100 - 50);
      let rotate = Math.floor(Math.random() * 360 - 180);

      anime({
        targets: this,
        translateY: randY,
        translateX: randX,
        rotate: rotate,
        duration: 1000,
      });
    });
  }

  // Animación color de autor en contenido con formato "repetido"
  // ----------------------------------------------------

  // let artistas = document.getElementsByClassName('artista-producto');

  // let R, G, B, dur;

  // const setVars = () => {
  //   R = Math.floor((Math.random() * 255)),
  //     G = Math.floor((Math.random() * 255)),
  //     B = Math.floor((Math.random() * 255)),
  //     dur = Math.floor((Math.random() * 4000));
  // }

  // const getColor = () => {
  //   setVars();
  //   return `rgb(${R}, ${G}, ${B})`;
  // };

  // setVars();

  // for (let i = 0; i < artistas.length; i++) {
  //   const element = artistas[i];

  //   element.addEventListener('mouseover', function (event) {

  //     anime({
  //       targets: this,
  //       color: getColor,
  //       duration: dur,
  //       loop: true,
  //       easing: 'linear',
  //       loopBegin: (anim) => {
  //         getColor();
  //       },k
  //     });

  //   });

  // element.addEventListener('mouseout', function (event) {
  //   colors.pause;
  // });
  // }
}
