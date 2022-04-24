let div = $('#tableMenuCategories')
let route = '/menu-manager/categories/list'
let structure = [' ', 'Estado', 'Nombre', 'Categoría', 'Tienda']

var MenuCategoriesTable = new tableGear(div, route, structure)
MenuCategoriesTable.filter.status = ''
MenuCategoriesTable.refresh(true)

let modalCreateMenuCategories = $('#modal-create-menu-categories')
let formCreateMenuCategories = $('form[name=form-create-menu-categories]')

function CreateMenuCategories() {
  CleanFormUtil(formCreateMenuCategories)
  queryCreateMenuCategories.Send()
}

//Get data modal
let queryCreateMenuCategories = new QueryAjax({
  url: '/menu-manager/categories/creation-information',
  method: 'GET',
  action: 'CreateMenuCategoriesInformation',
  listTable: MenuCategoriesTable,
})
function CreateMenuCategoriesInformation(status, result) {
  if (status) {
    LoadSelectUtil(
      modalCreateMenuCategories.find('select[name=store_id]'),
      result.data.stores,
    )
    LoadSelectUtil(
      modalCreateMenuCategories.find('select[name=category_id]'),
      result.data.categories,
    )
  }
}

//Send data modals
let SendCreateMenuCategories = new QueryAjax({
  form: 'form-create-menu-categories',
  action: 'ActionCreateMenuCategories',
  listTable: MenuCategoriesTable,
})
function ActionCreateMenuCategories(status, data) {
  if (status) {
    notify(false, 'Categoría creada', 'Operación realizada exitosamente', 2)
    SendCreateMenuCategories.FormClose()
    MenuCategoriesTable.refresh()
  }
}

//Update Store
let modalUpdateMenuCategories = $('#modal-update-menu-categories')
let formUpdateMenuCategories = $('form[name=form-update-menu-categories]')

//Funtion Modal Update
function UpdateMenuCategories(data) {
  MenuCategoriesTable.ModalClearForm(formUpdateMenuCategories)
  queryUpdateMenuCategories.var.id = data.id
  formUpdateMenuCategories.find('input[name=id]').val(data.id)
  queryUpdateMenuCategories.Send()
}

//Get data modal
let queryUpdateMenuCategories = new QueryAjax({
  url: '/menu-manager/categories/update-information',
  method: 'GET',
  action: 'UpdateMenuCategoriesInformation',
  listTable: MenuCategoriesTable,
})
function UpdateMenuCategoriesInformation(status, result) {
  if (status) {
    LoadSelectUtil(
      modalUpdateMenuCategories.find('select[name=store_id]'),
      result.data.stores,
      result.data.category.store_id,
    )
    LoadSelectUtil(
      modalUpdateMenuCategories.find('select[name=category_id]'),
      result.data.categories,
      result.data.category.category_id,
    )
    LoadFormInputs(modalUpdateMenuCategories, result.data.category)
  }
}

//Send Update Data Modal
let SendMenuCategoriesUpdate = new QueryAjax({
  form: 'form-update-menu-categories',
  action: 'MenuCategoriesUpdateAction',
  listTable: MenuCategoriesTable,
})
function MenuCategoriesUpdateAction(status, data) {
  if (status) {
    notify(false, 'Categoría actualizado', 'Operación realizada exitosamente', 2)
    SendMenuCategoriesUpdate.FormClose()
    MenuCategoriesTable.refresh()
  }
}

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
