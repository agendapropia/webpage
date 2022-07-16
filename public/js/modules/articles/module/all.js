let div = $('#tableMain')
let route = '/admin/articles/list'
let structure = [' ', 'Estado', 'Nombre', 'Tipo', 'Url', 'Fecha publicación', '# vistos']

var TableMain = new tableGear(div, route, structure)
TableMain.filter.special_id = ''
TableMain.filter.status_id = ''
TableMain.refresh(true)
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

let modalArticleUsers = $('#modal-article-users')
let formCreateArticleUsers = modalArticleUsers.find(
  'form[name=form-article-users]',
)

let divUser = $('#table-article-users')
let routeUser = '/admin/articles/users/list'
let structureUser = [' ', 'Nombre', 'Role']

var TableArticleUsers = new tableGear(divUser, routeUser, structureUser)
TableArticleUsers.modalSelect = modalArticleUsers
TableArticleUsers.tablePaginate = false
TableArticleUsers.filter.row = 200

function ActionModalUsers(data) {
  UtilClearFormUi(formCreateArticleUsers)

  modalArticleUsers.find('.modal-subtitle').text(` (${data.name})`)
  TableArticleUsers.filter.id = data.id
  formCreateArticleUsers.find('input[name=article_id]').val(data.id)

  TableArticleUsers.refresh(false)
  userSelectUpdate.clearSelect()
  QueryModalDataUsers.Send()
}
// Autocomplete
let userSelectUpdate = new searchByAutocomplete(
  formCreateArticleUsers.find('.usersSelect'),
  {
    params: [],
    url: '/admin/accounts/users/search-by-autocomplete',
    limitItems: 1,
    minimumCharactersToSearch: 1,
  },
)

/** --------- METHOD CREATE --------- */

let QueryModalDataUsers = new QueryAjax({
  url: '/admin/articles/roles',
  method: 'GET',
  action: 'ActionModalDataUsers',
  listTable: TableArticleUsers,
})
function ActionModalDataUsers(status, result) {
  if (status) {
    LoadSelectUtil(
      formCreateArticleUsers.find('select[name=article_role_id]'),
      result.data.roles,
    )
  }
}
let QueryModalCreateUsers = new QueryAjax({
  form: 'form-article-users',
  action: 'ActionModalCreateUsers',
  loaderSelected: modalArticleUsers.find('.overlay-modal'),
})
function ActionModalCreateUsers(status, result) {
  if (!status) {
    return false
  }

  if (result.status) {
    notify(false, 'Usuario asociado', 'Operación realizada exitosamente', 2)
    QueryModalCreateUsers.FormClose(false)
    TableArticleUsers.refresh(false)
  } else {
    notify(false, 'Usuario ya esta asociado', '', 1)
    QueryModalCreateUsers.FormClose(false)
  }

  userSelectUpdate.clearSelect()
}

/** --------- METHOD DELETE --------- */

function ButtonModalDeleteUsers(element) {
  let id = $(element).parent().parent().data('id')
  QueryModalDeleteUsers.var.id = id
  QueryModalDeleteUsers.Send()
}

let QueryModalDeleteUsers = new QueryAjax({
  url: '/admin/articles/users',
  method: 'DELETE',
  action: 'ActionModalDeleteUsers',
  listTable: TableArticleUsers,
})
function ActionModalDeleteUsers(status) {
  if (!status) {
    return false
  }
  notify(false, 'Usuario eliminado', 'Operación realizada exitosamente', 1)
  TableArticleUsers.refresh(false)
}

var modalFiles = $('#modal-utils-imagen-selections')

var divFiles = $('.div-files-class')
var selectImageType = $('select[name=image_type]')

var articleFiles = new updloadS3(divFiles, {
  url: '/admin/articles/files',
  typeFile: 1,
  id: 1,
  reload: false,
  limitFiles: 10
})

selectImageType.change(function () {
  articleFiles.clear()
  articleFiles.variables.source_id = $(this).val()
  articleFiles.loading.show()

  ActionQueryFilesList.var.type = $(this).val()
  ActionQueryFilesList.Send()
})

function ActionFilesLoad(data) {
  modalFiles.find('.modal-subtitle').text(`(${data.name})`)
  selectImageType.val(1)

  articleFiles.clear()
  articleFiles.variables.id = data.id
  articleFiles.variables.external_id = data.id
  articleFiles.variables.source_id = 1
  articleFiles.loading.show()

  ActionQueryFilesList.var.id = data.id
  ActionQueryFilesList.var.type = 1
  ActionQueryFilesList.Send()
}

let ActionQueryFilesList = new QueryAjax({
  url: '/admin/articles/files',
  method: 'GET',
  action: 'FinishActionQueryFilesList',
})
function FinishActionQueryFilesList(status, data) {
  if (status) {
    articleFiles.loadData(data.data, ActionQueryFilesList.var.id)
  }
}
