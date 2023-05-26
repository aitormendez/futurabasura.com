import {
  ftbs_product_quantity_increase,
  ftbs_product_quantity_decrease
} from './exports.js';

$(() => {
  if (document.body.classList.contains('variable')) {

    // Funcionalidad añadir al carro
    // ----------------------------------------------------

    let
      size = $("#ftbs_variationsTableRow_0").attr("attributevalue"),
      paFormat = $("#pa_format"),
      rows = $('.ftbs_variationsTableRow'),
      quantityInputsAdd = $('.ftbs_variationsTableRowColumn_quantityInput_add'),
      quantityInputsRemove = $('.ftbs_variationsTableRowColumn_quantityInput_remove');



    paFormat.val(size);

    function ftbs_singleProductAttributeInteraction() {
      let
        inputId = this.id,
        idNumber = inputId.split("_")[3],
        size = $("#ftbs_variationsTableRow_" + idNumber).attr("attributevalue");

      paFormat.val(size)

      $(".ftbs_variationsTableRow").addClass("ftbs_variationsTableRow_unselected");
      $("#ftbs_variationsTableRow_" + idNumber).removeClass("ftbs_variationsTableRow_unselected");

      $(".ftbs_variationsTableRowColumn_radioInput").attr("name", "");
      $(".ftbs_variationsTableRowColumn_radioInput").prop("checked", false);

      $("#ftbs_variationsTableRowColumn_radioInput_" + idNumber).attr("name", "attribute_pa_format");
      $("#ftbs_variationsTableRowColumn_radioInput_" + idNumber).prop("checked", true);

      var variation_id = $("#ftbs_variationsTableRowColumn_radioInput_" + idNumber).attr("variation_id");

      $('input[name="variation_id"]').val(variation_id);


      /** Get count input**/
      var quantityInput = $("#ftbs_variationsTableRowColumn_quantityInput");
      var quantityIncrease = $("#ftbs_variationsTableRowColumn_quantityInput_add");
      var quantityDecrease = $("#ftbs_variationsTableRowColumn_quantityInput_remove");

      /** Get empty input **/
      var quantityInput_inactive = $('#ftbs_variationsTableRowColumn_quantity_' + idNumber + ' .ftbs_variationsTableRowColumn_quantityInput_inactive');
      var quantityIncrease_inactive = $('#ftbs_variationsTableRowColumn_quantity_' + idNumber + ' .ftbs_variationsTableRowColumn_quantityInput_add_inactive');
      var quantityDecrease_inactive = $('#ftbs_variationsTableRowColumn_quantity_' + idNumber + ' .ftbs_variationsTableRowColumn_quantityInput_remove_inactive');

      /** Get row from remove element **/
      var insertFrom_input = $(quantityInput).parent();
      var insertFrom_increase = $(quantityIncrease).parent();
      var insertFrom_decrease = $(quantityDecrease).parent();

      /** Get destiny element **/
      var insertTo_input = $("#ftbs_variationsTableRowColumn_quantity_" + idNumber);
      var insertTo_increase = $("#ftbs_variationsTableRowColumn_quantity_" + idNumber);
      var insertTo_decrease = $("#ftbs_variationsTableRowColumn_quantity_" + idNumber);


      /** Remove count **/
      $(quantityInput).remove();
      $(quantityIncrease).remove();
      $(quantityDecrease).remove();

      /** Remove empty **/
      $(quantityInput_inactive).remove();
      $(quantityIncrease_inactive).remove();
      $(quantityDecrease_inactive).remove();

      /** Add count **/
      $(insertTo_input).append(quantityInput);
      $(insertTo_increase).append(quantityIncrease);
      $(insertTo_decrease).append(quantityDecrease);

      /** Add empty **/
      $(insertFrom_input).append(quantityInput_inactive);
      $(insertFrom_increase).append(quantityIncrease_inactive);
      $(insertFrom_decrease).append(quantityDecrease_inactive);

      $(".ftbs_variationsTableRowPadContainer").addClass("ftbs_variationsTableRowPadContainer_inactive");
      $(insertTo_input).parent().removeClass("ftbs_variationsTableRowPadContainer_inactive");

      /* Reset */
      quantityInput.value = 1;
      $('input[name="quantity"]').val(1)
      $('.ftbs_variationsTableRowColumn_quantityInput:not(.ftbs_variationsTableRowColumn_quantityInput_inactive)').val(1);
    }

    function ftbs_singleProductQuantityInteraction(input) {
      $('input[name="quantity"]').val(input.value)
    }

    function ftbs_clickOnProductVariationRow() {
      var id = (this.id).split("_")[2];
      if ($("#ftbs_variationsTableRowColumn_quantity_" + id).find("#ftbs_variationsTableRowColumn_quantityInput").length) {
        return false;
      }
      $("#ftbs_variationsTableRowColumn_radioInput_" + id).prop("checked", true);
      $("#ftbs_variationsTableRowColumn_radioInput_" + id).trigger("change");
    }

    for (var i = 0; i < quantityInputsAdd.length; i++) {
      quantityInputsAdd[i].addEventListener('click', ftbs_product_quantity_increase);
    }

    for (var i = 0; i < quantityInputsRemove.length; i++) {
      quantityInputsRemove[i].addEventListener('click', ftbs_product_quantity_decrease);
    }

    for (var i = 0; i < rows.length; i++) {
      rows[i].addEventListener('click', ftbs_clickOnProductVariationRow);
    }

    $('.ftbs_variationsTableRowColumn_radioInput').change(ftbs_singleProductAttributeInteraction);

    $('.ftbs_singleProductQuantityInteraction').change(ftbs_singleProductQuantityInteraction);




  }
});
