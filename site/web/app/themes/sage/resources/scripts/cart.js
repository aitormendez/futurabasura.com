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

  // inicializar selectWoo por mi cuentas porque no funciona en staging

  jQuery(function ($) {
    $(':input.wc-enhanced-select')
      .filter(':not(.enhanced)')
      .each(function () {
        const select2Args = {
          minimumResultsForSearch: 10,
          placeholder: $(this).attr('placeholder'),
          // Otros parámetros según tus necesidades
        };
        $(this).selectWoo(select2Args).addClass('enhanced');
      });
  });
}
