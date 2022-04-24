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
