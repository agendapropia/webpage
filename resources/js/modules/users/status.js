let modalStatusUser = $('#modal-status-user')

function ChangeStatusAction(data) {
  modalStatusUser
    .find('.label-user')
    .text(data.first_name + ' ' + data.last_name)

  let message = data.status_id ? 'inactivar' : 'activar'
  modalStatusUser.find('.label-query').text(message)

  let ico = data.status_id
    ? '<i class="si si-ban"></i>'
    : '<i class="si si-check"></i>'
  modalStatusUser.find('.btn-action').html(ico + ' ' + message)

  modalStatusUser.find('.button-status-send').text(message.toUpperCase())
  if (data.status_id) {
    modalStatusUser.find('.button-status-send').addClass('btn-danger')
  } else {
    modalStatusUser.find('.button-status-send').removeClass('btn-danger')
  }

  queryStatusUser.var.id = data.id
  queryStatusUser.var.status = data.status_id
}

function ButtonStatus() {
  modalStatusUser.find('.overlay').show()
  queryStatusUser.Send()
}
let queryStatusUser = new QueryAjax({
  url: '/accounts/users/status',
  method: 'PATCH',
  action: 'StatusUserModal',
  listTable: UserTable,
})
function StatusUserModal(status, data) {
  if (status) {
    modalStatusUser.find('.overlay').hide()
    modalStatusUser.modal('hide')
    notify(false, 'Usuario Actualizado', 'Operación realizada exitosamente', 2)
    UserTable.refresh()
  }
}
