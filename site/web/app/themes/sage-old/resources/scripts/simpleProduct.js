import {
  ftbs_product_quantity_increase,
  ftbs_product_quantity_decrease,
} from './exports.js';

export function anadirAlCarroSimple() {
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

export function resetearHiddenInput() {
  var quantityInput = document.querySelector('.quantity input');

  // Restablecer el valor a 1 al cargar la página
  if (quantityInput) {
    quantityInput.value = 1;
  }
}
