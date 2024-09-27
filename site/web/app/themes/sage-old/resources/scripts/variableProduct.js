import Alpine from 'alpinejs';

import {
  ftbs_product_quantity_increase,
  ftbs_product_quantity_decrease,
} from './exports.js';

export function anadirAlCarroVariable() {
  // Cantidad de productos a añadir al carro
  // ----------------------------------------------------

  // Encuentra los botones de aumento y disminución
  const btnAdd = document.getElementById('quantityInput_add');
  const btnRemove = document.getElementById('quantityInput_remove');

  // Añade eventos de clic para aumentar y disminuir
  if (btnAdd) {
    btnAdd.addEventListener('click', function () {
      ftbs_product_quantity_increase();
    });
  }

  if (btnRemove) {
    btnRemove.addEventListener('click', function () {
      ftbs_product_quantity_decrease();
    });
  }
}
