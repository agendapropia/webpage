let modalStatusMenuCategories = $('#modal-status-menu-categories')

function ChangeStatusAction(data) {
  modalStatusMenuCategories.find('.label-categories').text(data.name)

  let message = data.status_id ? 'inactivar' : 'activar'
  modalStatusMenuCategories.find('.label-query').text(message)

  let ico = data.status_id
    ? '<i class="si si-ban"></i>'
    : '<i class="si si-check"></i>'
  modalStatusMenuCategories.find('.btn-action').html(ico + ' ' + message)

  modalStatusMenuCategories
    .find('.button-status-send')
    .text(message.toUpperCase())
  if (data.status_id) {
    modalStatusMenuCategories.find('.button-status-send').addClass('btn-danger')
  } else {
    modalStatusMenuCategories
      .find('.button-status-send')
      .removeClass('btn-danger')
  }

  queryStatusMenuCategories.var.id = data.id
  queryStatusMenuCategories.var.status = data.status_id
}

function ButtonStatusAction() {
  modalStatusMenuCategories.find('.overlay').show()
  queryStatusMenuCategories.Send()
}

let queryStatusMenuCategories = new QueryAjax({
  url: '/menu-manager/categories/status',
  method: 'PATCH',
  action: 'StatusMenuCategoriesModal',
  listTable: MenuCategoriesTable,
})
function StatusMenuCategoriesModal(status, data) {
  if (status) {
    modalStatusMenuCategories.find('.overlay').hide()
    modalStatusMenuCategories.modal('hide')
    notify(false, 'Categoría Actualizado', 'Operación realizada exitosamente', 2)
    MenuCategoriesTable.refresh()
  }
}
