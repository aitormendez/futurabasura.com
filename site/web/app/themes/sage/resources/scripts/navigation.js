import { gsap } from 'gsap';

export function navigation() {
  // const menuBtn = document.getElementById('li-btn-menu');
  const btnMenuJS = document.getElementById('btn-menu');
  const btnCloseJS = document.getElementById('btn-close');

  btnMenuJS.addEventListener('click', function () {
    abreSolapa();
  });

  btnCloseJS.addEventListener('click', function () {
    cierraSolapa();
  });

  function abreSolapa() {
    gsap.to('#solapa', {
      x: '100vw',
    });
    gsap.to('#solapa li', {
      x: '52rem',
      stagger: 0.05,
      duration: 1,
      ease: 'elastic.out(1, 0.3)',
    });
  }

  function cierraSolapa() {
    gsap.to('#solapa', {
      x: 0,
    });
    gsap.to('#solapa li', {
      x: 0,
    });
  }
}
