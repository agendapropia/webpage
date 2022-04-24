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
