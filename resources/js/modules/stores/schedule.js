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
