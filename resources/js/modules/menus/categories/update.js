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
