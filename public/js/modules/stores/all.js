let div = $('#tableStores')
let route = '/store-manager/stores/list'
let structure = [' ', 'Estado', 'Nombre', 'Teléfono', 'Tipo']

var StoreTable = new tableGear(div, route, structure)
StoreTable.filter.status = ''
StoreTable.filter.store_types = ''
StoreTable.refresh(true)

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

let modalScheduleStore = $('#modal-schedule-store')
let formCreateStoreSchedule = modalScheduleStore.find(
  'form[name=form-create-schedule-store]',
)

// funtion open modal assign
function ScheduleStore(data) {
  modalScheduleStore.find('.name_store').text(data.name)
  scheduleStoreTable.form.url = '/store-manager/stores/' + data.id + '/schedules'
  CreateStoreSchedule.url = '/store-manager/stores/' + data.id + '/schedules'
  DeleteStoreSchedule.url = '/store-manager/stores/' + data.id + '/schedules'
  loadDataModalSchedule()
  scheduleStoreTable.ModalClearForm(formCreateStoreSchedule)
  scheduleStoreTable.refresh(false)
}

// list table schedules
let structureArrayTableSchedule = [' ', 'Día', 'Hora Inicio', 'Hora Final']
var scheduleStoreTable = new tableGear(
  $('#schedule-store'),
  '/store-manager/stores/_storeId_/schedule',
  structureArrayTableSchedule,
)
scheduleStoreTable.modalSelect = modalScheduleStore
scheduleStoreTable.tablePaginate = false
scheduleStoreTable.filter.row = 200
scheduleStoreTable.filter.order_by_column = 'day_id'
scheduleStoreTable.filter.order_by_type = 'ASC'

function loadDataModalSchedule() {
  modalScheduleStore.find('select[name=day_id]').val([])
  modalScheduleStore.find('input[name=start_time]').flatpickr(settingHour24)
  modalScheduleStore.find('input[name=end_time]').flatpickr(settingHour24)
}

let days = [
  { name: 'Domingo', value: 0 },
  { name: 'Lunes', value: 1 },
  { name: 'Martes', value: 2 },
  { name: 'Miercoles', value: 3 },
  { name: 'Jueves', value: 4 },
  { name: 'Viernes', value: 5 },
  { name: 'Sabado', value: 6 },
]
days.forEach(function (d) {
  modalScheduleStore
    .find('select[name=day_id]')
    .append(`<option value="${d.value}">${d.name}</option>`)
})

//Send new store schedules
let CreateStoreSchedule = new QueryAjax({
  form: 'form-create-schedule-store',
  action: 'StoreSchedulesCreateAction',
  listTable: scheduleStoreTable,
})
function StoreSchedulesCreateAction(status, data) {
  if (status) {
    notify(
      false,
      'Horario creado o actualizado',
      'Se asigno el nuevo horario a la tienda.',
      2,
    )
    CreateStoreSchedule.FormClose(false)
    loadDataModalSchedule()
    scheduleStoreTable.refresh(false)
  }
}


//Send new store schedules
function DeleteStoreScheduleButton(element) {
  let id = $(element).parent().parent().data('id');
  DeleteStoreSchedule.var.id = id
  DeleteStoreSchedule.Send()  
}

let DeleteStoreSchedule = new QueryAjax({
  url: '/store-manager/stores/{storeId}/schedules',
  method: 'DELETE',
  action: 'DeleteStoreScheduleAction',
  listTable: scheduleStoreTable,
})
function DeleteStoreScheduleAction(status, data) {
  if (status) {
    notify(
      false,
      'Horario eliminado',
      'Se elimino el horario de la tienda.',
      2,
    )
    scheduleStoreTable.refresh(false)
  }
}
