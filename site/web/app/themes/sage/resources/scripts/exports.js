export function ftbs_product_quantity_increase() {
  // Encuentra todos los inputs
  var inputs = document.querySelectorAll('.quantityInput');

  // Aumenta el valor de cada input
  inputs.forEach(function (input) {
    var currentValue = parseInt(input.value, 10);
    input.value = currentValue + 1;
  });

  // Actualiza el valor del input con nombre "quantity"
  var quantityInput = document.querySelector('input[name="quantity"]');
  if (quantityInput) {
    quantityInput.value = parseInt(inputs[0].value, 10);
  }
}

export function ftbs_product_quantity_decrease() {
  // Encuentra todos los inputs
  var inputs = document.querySelectorAll('.quantityInput');

  // Disminuye el valor de cada input asegurándose de que no sea menor que 1
  inputs.forEach(function (input) {
    var currentValue = parseInt(input.value, 10);
    var newValue = currentValue - 1 > 0 ? currentValue - 1 : 1;
    input.value = newValue;
  });

  // Actualiza el valor del input con nombre "quantity"
  var quantityInput = document.querySelector('input[name="quantity"]');
  if (quantityInput) {
    quantityInput.value =
      parseInt(inputs[0].value, 10) > 0 ? parseInt(inputs[0].value, 10) : 1;
  }
}
