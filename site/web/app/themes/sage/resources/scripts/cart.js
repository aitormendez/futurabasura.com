$(() => {
  if (document.body.classList.contains('cart')) {

    let btnActualizar = $("[name='update_cart']");

    // actualizar carrito al cambiar cantidad
    function actualizar() {
      btnActualizar.trigger("click");
    }

    $('.ftbsCartQuantityInput').change(function() {
      actualizar();
    });


    // aumentar y reducir cantidad con botones personalizados

    $('.product-quantity-add').each(function() {
      let id = $(this).parent('.botones-qty').siblings('.quantity').find('.ftbsCartQuantityInput').attr('id');
      $(this).click(function() {
        ftbsCartIncreaseProduct(id);
      }) ;
    })

    $('.product-quantity-remove').each(function() {
      let id = $(this).parent('.botones-qty').siblings('.quantity').find('.ftbsCartQuantityInput').attr('id');
      $(this).click(function() {
        ftbsCartDecreaseProduct(id);
      }) ;
    })

    function ftbsCartIncreaseProduct(id) {
      let curr = parseInt($('#' + id).val());
      $('#' + id).val(++curr);
      $("[name='update_cart']").prop("disabled", false);
      actualizar();
    }

    function ftbsCartDecreaseProduct(id) {
      let curr = parseInt($('#' + id).val());
      $('#' + id).val(--curr);
      $("[name='update_cart']").prop("disabled", false);
      actualizar();
    }
  }
});
