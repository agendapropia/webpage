let modalCreateMain = $('#modal-create-main')
let formCreateMain = $('form[name=form-create-main]')

function ActionMainCreate() {
  UtilFormClose(formCreateMain)
  queryCreateMain.Send()
  countrySelectCreate.clearSelect()
  tagsSelectCreate.clearSelect()
  regionsSelectCreate.clearSelect()
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
let regionsSelectCreate = new searchByAutocomplete(
  formCreateMain.find('.regionsSelect'),
  {
    params: [],
    url: '/admin/configurations/regions/search-by-autocomplete',
    limitItems: 10,
    minimumCharactersToSearch: 1,
  },
)

//Get data modal
let queryCreateMain = new QueryAjax({
  url: '/admin/articles/create',
  method: 'GET',
  action: 'CreateActionModal',
  listTable: TableMain,
})
function CreateActionModal(status, result) {
  if(status){
    LoadSelectUtil(
      modalCreateMain.find('select[name=article_type_id]'),
      result.data.articleTypes,
      1
    )
    LoadSelectUtil(
      modalCreateMain.find('select[name=special_id]'),
      result.data.specials,
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
