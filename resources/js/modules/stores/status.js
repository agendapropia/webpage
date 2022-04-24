let modalStatusStore = $('#modal-status-store')

function ChangeStatusAction(data) {
  modalStatusStore.find('.label-store').text(data.short_name)

  let message = data.status_id ? 'inactivar' : 'activar'
  modalStatusStore.find('.label-query').text(message)

  let ico = data.status_id
    ? '<i class="si si-ban"></i>'
    : '<i class="si si-check"></i>'
  modalStatusStore.find('.btn-action').html(ico + ' ' + message)

  queryStatusStore.var.id = data.id
  queryStatusStore.var.status = data.status_id
  console.log(data)
}

function ButtonStatus() {
  modalStatusStore.find('.overlay').show()
  queryStatusStore.Send()
}
let queryStatusStore = new QueryAjax({
  url: '/store-manager/stores/status',
  method: 'PATCH',
  action: 'StatusStoreModal',
  listTable: StoreTable,
})
function StatusStoreModal(status, data) {
  if (status) {
    modalStatusStore.find('.overlay').hide()
    modalStatusStore.modal('hide')
    notify(false, 'Usuario Actualizado', 'Operación realizada exitosamente', 2)
    StoreTable.refresh()
  }
}
