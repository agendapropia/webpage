let div = $('#tableUsers')
let route = '/admin/accounts/users/list'
let structure = [' ', 'Estado', 'Nombre', 'Teléfono', 'Idioma']

var UserTable = new tableGear(div, route, structure)
UserTable.filter.status = ''
UserTable.refresh(true)

let modalCreateUser = $('#modal-create-user')
let formCreateUser = $('form[name=form-create-user]')

function CreateUser() {
  UtilClearFormUi(formCreateUser)
  queryCreateUser.Send()
}

//Get data modal
let queryCreateUser = new QueryAjax({
  url: '/admin/accounts/users/create',
  method: 'GET',
  action: 'CreateUserModal',
  listTable: UserTable,
})
function CreateUserModal(status, result) {
  if (status) {
    LoadSelectUtil(
      modalCreateUser.find('select[name=gender_id]'),
      result.data.genders,
    )
    LoadSelectUtil(
      modalCreateUser.find('select[name=phone_code]'),
      result.data.countries,
    )
    LoadSelectUtil(
      modalCreateUser.find('select[name=location]'),
      [
        { id: 'es', name: 'Español' },
        { id: 'en', name: 'Ingles' },
      ],
      'es',
    )
  }
}

//Send data modal
let SendCreateUser = new QueryAjax({
  form: 'form-create-user',
  action: 'UserCreateAction',
  listTable: UserTable,
})
function UserCreateAction(status, data) {
  if (status) {
    notify(false, 'Usuario creado', 'Operación realizada exitosamente', 2)
    SendCreateUser.FormClose()
    UserTable.refresh()
  }
}

//Update User
let modalUpdateUser = $('#modal-update-user')
let formUpdateUser = $('form[name=form-update-user]')

//Funtion Modal Update
function UpdateUser(data) {
  UtilClearFormUi(formUpdateUser)
  queryUpdateUser.var.id = data.id
  formUpdateUser.find('input[name=id]').val(data.id)
  queryUpdateUser.Send()
}

//Get data modal
let queryUpdateUser = new QueryAjax({
  url: '/admin/accounts/users/update',
  method: 'GET',
  action: 'UpdateUserModal',
  listTable: UserTable,
})
function UpdateUserModal(status, result) {
  if (status) {
    LoadSelectUtil(
      modalUpdateUser.find('select[name=gender_id]'),
      result.data.genders,
      result.data.user.gender_id,
    )
    LoadSelectUtil(
      modalUpdateUser.find('select[name=phone_code]'),
      result.data.countries,
      result.data.user.phone_code,
    )
    LoadSelectUtil(
      modalUpdateUser.find('select[name=location]'),
      [
        { id: 'es', name: 'Español' },
        { id: 'en', name: 'Ingles' },
      ],
      result.data.user.location,
    )
    LoadFormInputs(modalUpdateUser, result.data.user)
  }
}

//Send Update Data Modal
let SendUserUpdate = new QueryAjax({
  form: 'form-update-user',
  action: 'UserUpdateAction',
  listTable: UserTable,
})
function UserUpdateAction(status, data) {
  if (status) {
    notify(false, 'Usuario Actualizado', 'Operación realizada exitosamente', 2)
    SendUserUpdate.FormClose()
    UserTable.refresh()
  }
}

let modalAssignRoles = $('#modal-assign-roles')

// funtion open modal assign
function AssignRoles(data) {
  modalAssignRoles
    .find('.name_user')
    .text(data.first_name + ' ' + data.last_name)
  assignRolesTable.form.url = '/admin/accounts/users/' + data.id + '/roles'
  SendRolesAssign.url = '/admin/accounts/users/' + data.id + '/assign'
  assignRolesTable.refresh(false)
}

// table permissions
let structure_array = [' ', 'Nombre', 'Description']
var assignRolesTable = new tableGear(
  $('#assign-roles'),
  '/admin/accounts/roles/_role_/permissions',
  structure_array,
  'selectedDataRoles',
)
assignRolesTable.tablePaginate = false
assignRolesTable.filter.row = 200

function selectedDataRoles(result) {
  assignRolesTable.CheckboxSelect(false)
  assignRolesTable.CheckboxArraySelect('role', 1)
}

// preparate data
function SendDataUserRoles() {
  let remove = []
  let add = []

  $.each(assignRolesTable.data_complete.data.data, function (elemt, data) {
    if (data.role == 1) {
      if (jQuery.inArray(data.id, assignRolesTable.checks) == -1) {
        remove.push(data.id)
      }
    } else {
      if (jQuery.inArray(data.id, assignRolesTable.checks) != -1) {
        add.push(data.id)
      }
    }
  })

  if (remove.length || add.length) {
    SendRolesAssign.var.remove = remove
    SendRolesAssign.var.add = add
    SendRolesAssign.Send()
  } else {
    SendRolesAssign.FormClose()
  }
}

//Send assign permissions
let SendRolesAssign = new QueryAjax({
  url: '/admin/accounts/roles/_role_/assign',
  method: 'POST',
  action: 'FinishAssignRoles',
  listTable: UserTable,
})
function FinishAssignRoles(status, data) {
  if (status) {
    notify(false, 'Roles Actualizado', 'Operación realizada exitosamente', 2)
    SendRolesAssign.FormClose()
  }
}

let modalStatusUser = $('#modal-status-user')

function ChangeStatusAction(data) {
  modalStatusUser
    .find('.label-user')
    .text(data.first_name + ' ' + data.last_name)

  let message = data.status_id ? 'inactivar' : 'activar'
  modalStatusUser.find('.label-query').text(message)

  let ico = data.status_id
    ? '<i class="si si-ban"></i>'
    : '<i class="si si-check"></i>'
  modalStatusUser.find('.btn-action').html(ico + ' ' + message)

  modalStatusUser.find('.button-status-send').text(message.toUpperCase())
  if (data.status_id) {
    modalStatusUser.find('.button-status-send').addClass('btn-danger')
  } else {
    modalStatusUser.find('.button-status-send').removeClass('btn-danger')
  }

  queryStatusUser.var.id = data.id
  queryStatusUser.var.status = data.status_id
}

function ButtonStatus() {
  modalStatusUser.find('.overlay').show()
  queryStatusUser.Send()
}
let queryStatusUser = new QueryAjax({
  url: '/admin/accounts/users/status',
  method: 'PATCH',
  action: 'StatusUserModal',
  listTable: UserTable,
})
function StatusUserModal(status, data) {
  if (status) {
    modalStatusUser.find('.overlay').hide()
    modalStatusUser.modal('hide')
    notify(false, 'Usuario Actualizado', 'Operación realizada exitosamente', 2)
    UserTable.refresh()
  }
}

const modalFiles = $('#modal-utils-imagen-selections')
const divFiles = $('.div-files-class')

var filesClass = new updloadS3(divFiles, {
  url: '/admin/accounts/users/files',
  typeFile: 1,
  id: 1,
  reload: false,
  altFunction: 'CloseModalFile',
  limitFiles: 1,
})

function ActionFilesLoad(data) {
  modalFiles
    .find('.modal-subtitle')
    .text(`(${data.first_name} ${data.last_name})`)

  filesClass.clear()
  filesClass.variables.id = data.id
  filesClass.variables.external_id = data.id
  filesClass.variables.source_id = 1
  filesClass.loading.show()

  ActionQueryFilesList.var.id = data.id
  ActionQueryFilesList.var.type = 1
  ActionQueryFilesList.Send()
}

let ActionQueryFilesList = new QueryAjax({
  url: '/admin/accounts/users/files',
  method: 'GET',
  action: 'FinishActionQueryFilesList',
})
function FinishActionQueryFilesList(status, data) {
  if (status) {
    filesClass.loadData(data.data, ActionQueryFilesList.var.id)
  }
  filesClass.loading.hide()
}

function CloseModalFile() {
  modalFiles.modal('hide')
  UserTable.refresh(true)
  notify(false, 'Imagen actualizada', 'Operación realizada exitosamente', 2)
}
