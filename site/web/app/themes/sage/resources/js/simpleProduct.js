import {
  ftbs_product_quantity_increase,
  ftbs_product_quantity_decrease,
} from './exports.js';

console.log('🔄 simpleProduct.js loaded');

export function anadirAlCarroSimple() {
  const btnAdd = document.getElementById('quantityInput_add');
  const btnRemove = document.getElementById('quantityInput_remove');
  const inputVisible = document.querySelector('.quantityInput');
  const inputHidden = document.querySelector('input[name="quantity"]');

  function syncQuantity() {
    console.log(
      `🔢 Sync quantity: visible=${inputVisible.value} → hidden=${inputHidden.value}`
    );

    if (inputVisible && inputHidden) {
      inputHidden.value = inputVisible.value;
    }
  }

  if (btnAdd) {
    btnAdd.addEventListener('click', function () {
      ftbs_product_quantity_increase();
      syncQuantity();
    });
  }

  if (btnRemove) {
    btnRemove.addEventListener('click', function () {
      ftbs_product_quantity_decrease();
      syncQuantity();
    });
  }

  // Si el usuario edita manualmente
  if (inputVisible) {
    inputVisible.addEventListener('input', syncQuantity);
  }
}

export function resetearHiddenInput() {
  console.log('🔄 Reset visible & hidden quantity to 1');

  const inputVisible = document.querySelector('.quantityInput');
  const inputHidden = document.querySelector('input[name="quantity"]');

  if (inputVisible) {
    inputVisible.value = 1;
  }

  if (inputHidden) {
    inputHidden.value = 1;
  }
}
