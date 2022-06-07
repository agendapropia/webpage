let modalCreateMain = $('#modal-create-main')
let formCreateMain = $('form[name=form-create-main]')

function ActionMainCreate() {
  UtilFormClose(formCreateMain)
  queryCreateMain.Send()
  countrySelectCreate.clearSelect()
}

// Autocomplete
let countrySelectCreate = new searchByAutocomplete(
  formCreateMain.find('.countrySelect'),
  {
    params: [],
    url: '/admin/configurations/countries/search-by-autocomplete',
    limitItems: 2,
  },
)

//Get data modal
let queryCreateMain = new QueryAjax({
  url: '/admin/configurations/regions/create',
  method: 'GET',
  action: 'CreateActionModal',
  listTable: TableMain,
})
function CreateActionModal(status, result) {
}

//Send data modal
let ActionSendMain = new QueryAjax({
  form: 'form-create-main',
  action: 'FinishActionCreateMain',
  listTable: TableMain,
})
function FinishActionCreateMain(status) {
  if (status) {
    notify(false, 'Region creado', 'Operación realizada exitosamente', 2)
    ActionSendMain.FormClose()
    TableMain.refresh()
  }
}

let div = $('#tableMain')
let route = '/admin/configurations/regions/list'
let structure = [' ', 'Nombre', 'Pais']

var TableMain = new tableGear(div, route, structure)
TableMain.filter.country = ''
TableMain.refresh(true)


let modalUpdateMain = $('#modal-update-main')
let formUpdateMain = $('form[name=form-update-main]')

//Funtion Modal Update
function ActionMainUpdate(data) {
  UtilClearFormUi(formUpdateMain)
  queryInitialUpdateMain.var.id = data.id
  formUpdateMain.find('input[name=id]').val(data.id)
  queryInitialUpdateMain.Send()
  countrySelectUpdate.clearSelect()
}

let countrySelectUpdate = new searchByAutocomplete(
  formUpdateMain.find('.countrySelect'),
  {
    params: [],
    url: '/admin/configurations/countries/search-by-autocomplete',
    limitItems: 1,
  },
)

//Get data modal
let queryInitialUpdateMain = new QueryAjax({
  url: '/admin/configurations/regions/update',
  method: 'GET',
  action: 'UpdateActionModal',
  listTable: TableMain,
})
function UpdateActionModal(status, result) {
  if (status) {
    let country = result.data.country
    countrySelectUpdate.eventAddDataSelected({
      id: country.id,
      name: country.name,
    })

    LoadFormInputs(modalUpdateMain, result.data.region)
  }
}

//Send Update Data Modal
let ActionMainUpdateSend = new QueryAjax({
  form: 'form-update-main',
  action: 'FunctionActionUpdateMain',
  listTable: TableMain,
})
function FunctionActionUpdateMain(status, data) {
  if (status) {
    notify(false, 'Region Actualizado', 'Operación realizada exitosamente', 2)
    ActionMainUpdateSend.FormClose()
    TableMain.refresh()
  }
}
