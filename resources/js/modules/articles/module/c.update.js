let modalUpdateMain = $('#modal-update-main')
let formUpdateMain = $('form[name=form-update-main]')

//Funtion Modal Update
function ActionMainUpdate(data) {
  UtilClearFormUi(formUpdateMain)
  queryInitialUpdateMain.var.id = data.id
  formUpdateMain.find('input[name=id]').val(data.id)
  queryInitialUpdateMain.Send()
  countrySelectUpdate.clearSelect()
  tagsSelectUpdate.clearSelect()
  regionSelectUpdate.clearSelect()
  modalUpdateMain.find('input[name=publication_date]').flatpickr(settingDate)
}

// Autocomplete
let countrySelectUpdate = new searchByAutocomplete(
  formUpdateMain.find('.countrySelect'),
  {
    params: [],
    url: '/admin/configurations/countries/search-by-autocomplete',
    limitItems: 10,
    minimumCharactersToSearch: 1,
  },
)
let tagsSelectUpdate = new searchByAutocomplete(
  formUpdateMain.find('.tagsSelect'),
  {
    params: [],
    url: '/admin/configurations/tags/search-by-autocomplete',
    limitItems: 10,
    minimumCharactersToSearch: 1,
  },
)
let regionSelectUpdate = new searchByAutocomplete(
  formUpdateMain.find('.regionsSelect'),
  {
    params: [],
    url: '/admin/configurations/regions/search-by-autocomplete',
    limitItems: 10,
    minimumCharactersToSearch: 1,
  },
)

//Get data modal
let queryInitialUpdateMain = new QueryAjax({
  url: '/admin/articles/update',
  method: 'GET',
  action: 'UpdateActionModal',
  listTable: TableMain,
})
function UpdateActionModal(status, result) {
  if (status) {
    utilLoadAutoCompleteByArray(result.data.countries, countrySelectUpdate)
    utilLoadAutoCompleteByArray(result.data.tags, tagsSelectUpdate)
    utilLoadAutoCompleteByArray(result.data.regions, regionSelectUpdate)

    LoadSelectUtil(
      modalUpdateMain.find('select[name=special_id]'),
      result.data.specials,
      result.data.article.special_id,
    )
    LoadSelectUtil(
      modalUpdateMain.find('select[name=article_type_id]'),
      result.data.articleTypes,
      result.data.article.article_type_id,
    )

    LoadFormInputs(modalUpdateMain, result.data.article)
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
    notify(false, 'Earticle Actualizado', 'Operación realizada exitosamente', 2)
    ActionMainUpdateSend.FormClose()
    TableMain.refresh()
  }
}
