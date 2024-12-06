export function carrito() {
  const quantityContainers = document.querySelectorAll('.botones-qty');

  quantityContainers.forEach(function (container) {
    const input = container
      .closest('.tk-row')
      .querySelector('.cartQuantityInput');

    const incrementButton = container.querySelector('.product-quantity-add');
    incrementButton.addEventListener('click', function () {
      let currentValue = parseInt(input.value);
      const maxValue = parseInt(input.getAttribute('max')) || 9999;

      if (currentValue < maxValue) {
        currentValue++;
        input.value = currentValue;
        input.dispatchEvent(new Event('change'));
      }
    });

    const decrementButton = container.querySelector('.product-quantity-remove');
    decrementButton.addEventListener('click', function () {
      let currentValue = parseInt(input.value);
      const minValue = parseInt(input.getAttribute('min')) || 0;

      if (currentValue > minValue) {
        currentValue--;
        input.value = currentValue;
        input.dispatchEvent(new Event('change'));
      }
    });
  });

  document.querySelectorAll('.cartQuantityInput').forEach(function (input) {
    input.addEventListener('change', function () {
      const updateCartButton = document.querySelector(
        'button[name="update_cart"]',
      );
      if (updateCartButton) {
        updateCartButton.disabled = false; // Forzar la habilitación del botón
        updateCartButton.click();
      }
    });
  });

  // Manejo del botón de eliminar producto
  const removeLinks = document.querySelectorAll('.product-remove a');
  removeLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {
      event.preventDefault(); // Evitar la acción predeterminada del enlace

      // Desactivar interacción en la página
      document.body.style.pointerEvents = 'none';
      document.body.style.opacity = '0.5';

      // Redirigir a la URL de eliminación para que WooCommerce procese la eliminación
      window.location.href = this.href;
    });
  });

  // inicializar selectWoo por mi cuenta porque no funciona en staging

  jQuery(function ($) {
    // Inicializa selectWoo en el país y el estado
    $('#calc_shipping_country, #calc_shipping_state').selectWoo({
      minimumResultsForSearch: 10,
      placeholder: 'Select an option…',
    });

    // Escucha el evento de actualización de WooCommerce
    $(document.body).on('country_to_state_changed', function () {
      const $stateSelect = $('#calc_shipping_state');
      if ($stateSelect.length > 0) {
        // Destruye selectWoo si ya está inicializado
        if ($stateSelect.hasClass('select2-hidden-accessible')) {
          $stateSelect.selectWoo('destroy');
        }
        // Reinicializa selectWoo con las nuevas opciones
        $stateSelect.selectWoo({
          minimumResultsForSearch: 10,
          placeholder: 'Select an option…',
        });
      }
    });
  });
}
