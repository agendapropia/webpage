let div = $('#tableMain')
let route = '/admin/specials/list'
let structure = [' ', 'Estado', 'Nombre', 'Url', 'Fecha publicación', '# vistos']

var TableMain = new tableGear(div, route, structure)
TableMain.refresh(true)
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
  alliedMediasSelectUpdate.clearSelect()
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
let alliedMediasSelectUpdate = new searchByAutocomplete(
  formUpdateMain.find('.alliedMediaSelect'),
  {
    params: [],
    url: '/admin/specials/allied-media/search-by-autocomplete',
    limitItems: 10,
    minimumCharactersToSearch: 1,
  },
)

//Get data modal
let queryInitialUpdateMain = new QueryAjax({
  url: '/admin/specials/update',
  method: 'GET',
  action: 'UpdateActionModal',
  listTable: TableMain,
})
function UpdateActionModal(status, result) {
  if (status) {
    utilLoadAutoCompleteByArray(result.data.countries, countrySelectUpdate)
    utilLoadAutoCompleteByArray(result.data.tags, tagsSelectUpdate)
    utilLoadAutoCompleteByArray(
      result.data.alliedMedia,
      alliedMediasSelectUpdate,
    )

    LoadSelectUtil(
      modalUpdateMain.find('select[name=template_id]'),
      result.data.templates,
      result.data.special.template_id,
    )

    LoadFormInputs(modalUpdateMain, result.data.special)
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
    notify(false, 'Especial Actualizado', 'Operación realizada exitosamente', 2)
    ActionMainUpdateSend.FormClose()
    TableMain.refresh()
  }
}

let modalSpecialUsers = $('#modal-special-users')
let formCreateSpecialUsers = modalSpecialUsers.find(
  'form[name=form-special-users]',
)

let divUser = $('#table-special-users')
let routeUser = '/admin/specials/users/list'
let structureUser = [' ', 'Nombre', 'Role']

var TableSpecialUsers = new tableGear(divUser, routeUser, structureUser)
TableSpecialUsers.modalSelect = modalSpecialUsers
TableSpecialUsers.tablePaginate = false
TableSpecialUsers.filter.row = 200

function ActionModalUsers(data) {
  UtilClearFormUi(formCreateSpecialUsers)

  modalSpecialUsers.find('.modal-subtitle').text(` (${data.name})`)
  TableSpecialUsers.filter.id = data.id
  formCreateSpecialUsers.find('input[name=special_id]').val(data.id)

  TableSpecialUsers.refresh(false)
  userSelectUpdate.clearSelect()
  QueryModalDataUsers.Send()
}
// Autocomplete
let userSelectUpdate = new searchByAutocomplete(
  formCreateSpecialUsers.find('.usersSelect'),
  {
    params: [],
    url: '/admin/accounts/users/search-by-autocomplete',
    limitItems: 1,
    minimumCharactersToSearch: 1,
  },
)

/** --------- METHOD CREATE --------- */

let QueryModalDataUsers = new QueryAjax({
  url: '/admin/specials/roles',
  method: 'GET',
  action: 'ActionModalDataUsers',
  listTable: TableSpecialUsers,
})
function ActionModalDataUsers(status, result) {
  if (status) {
    LoadSelectUtil(
      formCreateSpecialUsers.find('select[name=special_role_id]'),
      result.data.roles,
    )
  }
}
let QueryModalCreateUsers = new QueryAjax({
  form: 'form-special-users',
  action: 'ActionModalCreateUsers',
  loaderSelected: modalSpecialUsers.find('.overlay-modal'),
})
function ActionModalCreateUsers(status, result) {
  if (!status) {
    return false
  }

  if (result.status) {
    notify(false, 'Usuario asociado', 'Operación realizada exitosamente', 2)
    QueryModalCreateUsers.FormClose(false)
    TableSpecialUsers.refresh(false)
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
  url: '/admin/specials/users',
  method: 'DELETE',
  action: 'ActionModalDeleteUsers',
  listTable: TableSpecialUsers,
})
function ActionModalDeleteUsers(status) {
  if (!status) {
    return false
  }
  notify(false, 'Usuario eliminado', 'Operación realizada exitosamente', 1)
  TableSpecialUsers.refresh(false)
}

var modalFiles = $('#modal-utils-imagen-selections')

var divFiles = $('.div-files-class')
var selectImageType = $('select[name=image_type]')

var specialFiles = new updloadS3(divFiles, {
  url: '/admin/specials/files',
  typeFile: 1,
  id: 1,
  reload: false,
  limitFiles: 10
})

selectImageType.change(function () {
  specialFiles.clear()
  specialFiles.variables.source_id = $(this).val()
  specialFiles.loading.show()

  ActionQueryFilesList.var.type = $(this).val()
  ActionQueryFilesList.Send()
})

function ActionFilesLoad(data) {
  modalFiles.find('.modal-subtitle').text(`(${data.name})`)
  selectImageType.val(1)

  specialFiles.clear()
  specialFiles.variables.id = data.id
  specialFiles.variables.external_id = data.id
  specialFiles.variables.source_id = 1
  specialFiles.loading.show()

  ActionQueryFilesList.var.id = data.id
  ActionQueryFilesList.var.type = 1
  ActionQueryFilesList.Send()
}

let ActionQueryFilesList = new QueryAjax({
  url: '/admin/specials/files',
  method: 'GET',
  action: 'FinishActionQueryFilesList',
})
function FinishActionQueryFilesList(status, data) {
  if (status) {
    specialFiles.loadData(data.data, ActionQueryFilesList.var.id)
  }
}
