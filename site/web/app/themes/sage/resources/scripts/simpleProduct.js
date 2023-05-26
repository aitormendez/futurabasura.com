import {
  ftbs_product_quantity_increase,
  ftbs_product_quantity_decrease
 } from './exports.js';

 $(() => {
  if (document.body.classList.contains('simple')) {

    // Cantidad de productos a añadir al carro
    // ----------------------------------------------------

    let
      btnAdd = $('#ftbs_variationsTableRowColumn_quantityInput_add'),
      btnRemove = $('#ftbs_variationsTableRowColumn_quantityInput_remove');

    btnAdd.click(function(){
      ftbs_product_quantity_increase();
    });

    btnRemove.click(function(){
      ftbs_product_quantity_decrease();
    });

  }
});
