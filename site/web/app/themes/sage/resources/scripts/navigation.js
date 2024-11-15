import { gsap, random } from 'gsap';

export function navigation() {
  // const menuBtn = document.getElementById('li-btn-menu');
  const btnMenuJS = document.getElementById('btn-menu');
  const btnCloseJS = document.getElementById('btn-close');
  const solapa = document.getElementById('solapa');

  btnMenuJS.addEventListener('click', function () {
    abreSolapa();
  });

  btnCloseJS.addEventListener('click', function () {
    cierraSolapa();
  });

  function abreSolapa() {
    solapa.classList.remove('pointer-events-none');

    gsap.to('#solapa', {
      opacity: 1,
    });

    gsap.to('#solapa li', {
      rotate: () => (Math.random() - 0.5) * 2 * 20,
      stagger: 0.05,
      duration: 1,
      ease: 'elastic.out(1, 0.3)',
    });

    gsap.to('#solapa li', {
      x: '0',
      opacity: 1,
      stagger: 0.1,
      duration: 0.5,
    });
  }

  function cierraSolapa() {
    solapa.classList.add('pointer-events-none');

    gsap.to('#solapa', {
      opacity: 0,
      duration: 0.5,
    });

    gsap.set('#solapa li', {
      opacity: 0,
      rotate: () => (Math.random() - 0.5) * 2 * 600,
    });
  }
}
