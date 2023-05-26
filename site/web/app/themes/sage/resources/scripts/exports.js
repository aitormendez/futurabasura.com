export function ftbs_product_quantity_increase() {
  var input = $(".ftbs_variationsTableRowColumn_quantityInput:not(.ftbs_variationsTableRowColumn_quantityInput_inactive)").val();
  $(".ftbs_variationsTableRowColumn_quantityInput:not(.ftbs_variationsTableRowColumn_quantityInput_inactive)").val(++input)
  $('input[name="quantity"]').val(input)
}

export function ftbs_product_quantity_decrease() {
  var input = $(".ftbs_variationsTableRowColumn_quantityInput:not(.ftbs_variationsTableRowColumn_quantityInput_inactive)").val();
  $(".ftbs_variationsTableRowColumn_quantityInput:not(.ftbs_variationsTableRowColumn_quantityInput_inactive)").val(((--input)>0)?input:1);
  $('input[name="quantity"]').val(((input)>0)?input:1);
}
