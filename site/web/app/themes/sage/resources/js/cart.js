export function carrito() {
  let debounceTimeout = null;

  function attachListenersToForm(form) {
    if (!form) return;

    form.addEventListener('input', (event) => {
      const target = event.target;
      if (
        target.matches('input.qty') &&
        target.type === 'number' &&
        target.name.startsWith('cart[')
      ) {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
          const updateBtn = form.querySelector('button[name="update_cart"]');
          if (updateBtn) {
            updateBtn.disabled = false;
            updateBtn.click();
          }
        }, 1000);
      }
    });
  }

  const observer = new MutationObserver((mutationsList) => {
    for (const mutation of mutationsList) {
      for (const node of mutation.addedNodes) {
        if (node.nodeType === 1 && node.matches('form.woocommerce-cart-form')) {
          attachListenersToForm(node);
        }
      }
    }
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true,
  });

  // Inicialización
  const initialForm = document.querySelector('form.woocommerce-cart-form');
  if (initialForm) {
    attachListenersToForm(initialForm);
  }
}
