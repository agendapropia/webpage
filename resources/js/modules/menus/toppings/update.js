//Update Store
let modalUpdateMenuTopping = $('#modal-update-menu-toppings')
let formUpdateMenuTopping = $('form[name=form-update-menu-toppings]')

//Funtion Modal Update
function UpdateMenuTopping(data) {
  MenuToppingTable.ModalClearForm(formUpdateMenuTopping)
  queryUpdateMenuTopping.var.id = data.id
  formUpdateMenuTopping.find('input[name=id]').val(data.id)
  queryUpdateMenuTopping.Send()
}

//Get data modal
let queryUpdateMenuTopping = new QueryAjax({
  url: '/menu-manager/toppings/update-information',
  method: 'GET',
  action: 'UpdateMenuToppingInformation',
  listTable: MenuToppingTable,
})
function UpdateMenuToppingInformation(status, result) {
  if (status) {
    LoadSelectUtil(
      modalUpdateMenuTopping.find('select[name=store_id]'),
      result.data.stores,
      result.data.topping.store_id,
    )
    LoadFormInputs(modalUpdateMenuTopping, result.data.topping)
  }
}

//Send Update Data Modal
let SendMenuToppingUpdate = new QueryAjax({
  form: 'form-update-menu-toppings',
  action: 'MenuToppingUpdateAction',
  listTable: MenuToppingTable,
})
function MenuToppingUpdateAction(status, data) {
  if (status) {
    notify(false, 'Tienda actualizado', 'Operación realizada exitosamente', 2)
    SendMenuToppingUpdate.FormClose()
    MenuToppingTable.refresh()
  }
}
