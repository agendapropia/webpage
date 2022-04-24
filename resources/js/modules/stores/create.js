let modalCreateStore = $('#modal-create-store')
let formCreateStore = $('form[name=form-create-store]')

function CreateStore() {
  StoreTable.ModalClearForm(formCreateStore)
  queryCreateStore.Send()
}

//Get data modal
let queryCreateStore = new QueryAjax({
  url: '/store-manager/stores/create',
  method: 'GET',
  action: 'CreateStoreModal',
  listTable: StoreTable,
})
function CreateStoreModal(status, result) {
  if (status) {
    let select = modalCreateStore.find('select[name=store_type_id]')
    StoreTable.LoadSelect(select, result.data.store_types)
    select = modalCreateStore.find('select[name=store_status_id]')
    StoreTable.LoadSelect(select, result.data.store_status)
    select = modalCreateStore.find('select[name=phone_code]')
    StoreTable.LoadSelect(select, result.data.countries)
    select = modalCreateStore.find('select[name=city_id]')
    StoreTable.LoadSelect(select, result.data.cities)
  }
}

//Send data modal
let SendCreateStore = new QueryAjax({
  form: 'form-create-store',
  action: 'StoreCreateAction',
  listTable: StoreTable,
})
function StoreCreateAction(status, data) {
  if (status) {
    notify(false, 'Tienda creada', 'Operación realizada exitosamente', 2)
    SendCreateStore.FormClose()
    StoreTable.refresh()
  }
}
