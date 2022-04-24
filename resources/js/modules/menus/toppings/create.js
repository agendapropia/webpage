let modalCreateMenuToppings = $('#modal-create-menu-toppings')
let formCreateMenuToppings = $('form[name=form-create-menu-toppings]')

function CreateMenuToppings() {
  CleanFormUtil(formCreateMenuToppings)
  queryCreateMenuToppings.Send()
}

//Get data modal
let queryCreateMenuToppings = new QueryAjax({
  url: '/menu-manager/toppings/creation-information',
  method: 'GET',
  action: 'CreateMenuToppingsInformation',
  listTable: MenuToppingTable,
})
function CreateMenuToppingsInformation(status, result) {
  if (status) {
    LoadSelectUtil(
      modalCreateMenuToppings.find('select[name=store_id]'),
      result.data.stores,
    )
  }
}

//Send data modals
let SendCreateMenuToppings = new QueryAjax({
  form: 'form-create-menu-toppings',
  action: 'ActionCreateMenuToppings',
  listTable: MenuToppingTable,
})
function ActionCreateMenuToppings(status, data) {
  if (status) {
    notify(false, 'Tienda creada', 'Operación realizada exitosamente', 2)
    SendCreateMenuToppings.FormClose()
    MenuToppingTable.refresh()
  }
}
