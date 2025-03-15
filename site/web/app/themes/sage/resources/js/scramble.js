import Scrambler from 'scrambling-text';

export default function scramble() {
  // scramble text en brand
  // https://github.com/sogoagain/scrambling-text-js
  // ---------------------------------------------------------
  const TEXTS = fb.frases;

  const scrambler = new Scrambler();
  const handleScramble = (text) => {
    document.getElementById('brand').innerHTML = text;
  };

  let i = 0;
  function printText() {
    scrambler.scramble(TEXTS[i % TEXTS.length], handleScramble);
    setTimeout(printText, 30000);
    i++;
  }
  setTimeout(printText, 10000);
}
