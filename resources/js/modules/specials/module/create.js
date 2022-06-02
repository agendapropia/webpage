let modalCreateMain = $('#modal-create-main')
let formCreateMain = $('form[name=form-create-main]')

function ActionMainCreate() {
  UtilFormClose(formCreateMain)
  queryCreateMain.Send()
  countrySelectCreate.clearSelect()
  tagsSelectCreate.clearSelect()
  alliedMediasSelectCreate.clearSelect()
  modalCreateMain.find('input[name=publication_date]').flatpickr(settingDate)
}

// Autocomplete
let countrySelectCreate = new searchByAutocomplete(
  formCreateMain.find('.countrySelect'),
  {
    params: [],
    url: '/admin/configurations/countries/search-by-autocomplete',
    limitItems: 10,
    minimumCharactersToSearch: 1,
  },
)
let tagsSelectCreate = new searchByAutocomplete(
  formCreateMain.find('.tagsSelect'),
  {
    params: [],
    url: '/admin/configurations/tags/search-by-autocomplete',
    limitItems: 10,
    minimumCharactersToSearch: 1,
  },
)
let alliedMediasSelectCreate = new searchByAutocomplete(
  formCreateMain.find('.alliedMediaSelect'),
  {
    params: [],
    url: '/admin/specials/allied-media/search-by-autocomplete',
    limitItems: 10,
    minimumCharactersToSearch: 1,
  },
)

//Get data modal
let queryCreateMain = new QueryAjax({
  url: '/admin/specials/create',
  method: 'GET',
  action: 'CreateActionModal',
  listTable: TableMain,
})
function CreateActionModal(status, result) {
  if(status){
    LoadSelectUtil(
      modalCreateMain.find('select[name=template_id]'),
      result.data.templates,
      1
    )
  }
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
