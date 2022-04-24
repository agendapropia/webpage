let div = $('#tableMenuToppings')
let route = '/menu-manager/toppings/list'
let structure = [' ', 'Estado', 'Nombre', 'Descripción', 'Tienda']

var MenuToppingTable = new tableGear(div, route, structure)
MenuToppingTable.filter.status = ''
MenuToppingTable.refresh(true)

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

let modalStatusMenuTopping = $('#modal-status-menu-topping')

function ChangeStatusAction(data) {
  modalStatusMenuTopping.find('.label-topping').text(data.name)

  let message = data.status_id ? 'inactivar' : 'activar'
  modalStatusMenuTopping.find('.label-query').text(message)

  let ico = data.status_id
    ? '<i class="si si-ban"></i>'
    : '<i class="si si-check"></i>'
  modalStatusMenuTopping.find('.btn-action').html(ico + ' ' + message)

  modalStatusMenuTopping.find('.button-status-send').text(message.toUpperCase())
  if (data.status_id) {
    modalStatusMenuTopping.find('.button-status-send').addClass('btn-danger')
  } else {
    modalStatusMenuTopping.find('.button-status-send').removeClass('btn-danger')
  }

  queryStatusMenuTopping.var.id = data.id
  queryStatusMenuTopping.var.status = data.status_id
}

function ButtonStatusAction() {
  modalStatusMenuTopping.find('.overlay').show()
  queryStatusMenuTopping.Send()
}

let queryStatusMenuTopping = new QueryAjax({
  url: '/menu-manager/toppings/status',
  method: 'PATCH',
  action: 'StatusMenuToppingModal',
  listTable: MenuToppingTable,
})
function StatusMenuToppingModal(status, data) {
  if (status) {
    modalStatusMenuTopping.find('.overlay').hide()
    modalStatusMenuTopping.modal('hide')
    notify(false, 'Usuario Actualizado', 'Operación realizada exitosamente', 2)
    MenuToppingTable.refresh()
  }
}
