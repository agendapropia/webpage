//Update Store
let modalUpdateStore = $('#modal-update-store')
let formUpdateStore = $('form[name=form-update-store]')

//Funtion Modal Update
function UpdateStore(data) {
  StoreTable.ModalClearForm(formUpdateStore)
  queryUpdateStore.var.id = data.id
  formUpdateStore.find('input[name=id]').val(data.id)
  queryUpdateStore.Send()
}

//Get data modal
let queryUpdateStore = new QueryAjax({
  url: '/store-manager/stores/update',
  method: 'GET',
  action: 'UpdateStoreModal',
  listTable: StoreTable,
})
function UpdateStoreModal(status, result) {
  if (status) {
    let select = modalUpdateStore.find('select[name=store_type_id]')
    StoreTable.LoadSelect(
      select,
      result.data.store_types,
      result.data.store.store_type_id,
    )
    select = modalUpdateStore.find('select[name=store_status_id]')
    StoreTable.LoadSelect(
      select,
      result.data.store_status,
      result.data.store.store_status_id,
    )
    select = modalUpdateStore.find('select[name=phone_code]')
    StoreTable.LoadSelect(
      select,
      result.data.countries,
      result.data.store.phone_code,
    )
    select = modalUpdateStore.find('select[name=city_id]')
    StoreTable.LoadSelect(select, result.data.cities, result.data.store.city_id)
    LoadFormInputs(modalUpdateStore, result.data.store)
  }
}

//Send Update Data Modal
let SendStoreUpdate = new QueryAjax({
  form: 'form-update-store',
  action: 'StoreUpdateAction',
  listTable: StoreTable,
})
function StoreUpdateAction(status, data) {
  if (status) {
    notify(false, 'Tienda actualizado', 'Operación realizada exitosamente', 2)
    SendStoreUpdate.FormClose()
    StoreTable.refresh()
  }
}
