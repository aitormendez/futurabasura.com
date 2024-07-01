import anime from 'animejs';

export default function solapa() {
  let btnMenuJS = document.getElementById('btn-menu');
  let btnCloseJS = document.getElementById('btn-close');

  btnMenuJS.addEventListener('click', function () {
    anime({
      targets: '#solapa',
      translateX: '100vw',
      duration: 100,
      easing: 'linear',
    });
    anime({
      targets: '#solapa li',
      translateX: '52rem',
      // rotate: Math.floor((Math.random() * 20) - 10),
      duration: 500,
      easing: 'easeOutElastic(1, .6)',
      delay: anime.stagger(50),
    });
  });

  btnCloseJS.addEventListener('click', function () {
    anime({
      targets: '#solapa',
      translateX: 0,
      duration: 100,
      easing: 'linear',
    });

    anime({
      targets: '#solapa li',
      // rotate: 0,
      duration: 100,
      translateX: 0,
    });
  });
}
