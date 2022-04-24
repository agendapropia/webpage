let div = $('#tableUsers')
let route = '/accounts/users/list'
let structure = [' ', 'Estado', 'Nombre', 'Teléfono', 'Idioma']

var UserTable = new tableGear(div, route, structure)
UserTable.filter.status = ''
UserTable.refresh(true)

let modalCreateUser = $('#modal-create-user')
let formCreateUser = $('form[name=form-create-user]')

function CreateUser() {
  UserTable.ModalClearForm(formCreateUser)
  queryCreateUser.Send()
}

//Get data modal
let queryCreateUser = new QueryAjax({
  url: '/accounts/users/create',
  method: 'GET',
  action: 'CreateUserModal',
  listTable: UserTable,
})
function CreateUserModal(status, result) {
  if (status) {
    let select = modalCreateUser.find('select[name=gender_id]')
    UserTable.LoadSelect(select, result.data.genders)
    select = modalCreateUser.find('select[name=phone_code]')
    UserTable.LoadSelect(select, result.data.countries)
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
  UserTable.ModalClearForm(formUpdateUser)
  queryUpdateUser.var.id = data.id
  formUpdateUser.find('input[name=id]').val(data.id)
  queryUpdateUser.Send()
}

//Get data modal
let queryUpdateUser = new QueryAjax({
  url: '/accounts/users/update',
  method: 'GET',
  action: 'UpdateUserModal',
  listTable: UserTable,
})
function UpdateUserModal(status, result) {
  if (status) {
    let select = modalUpdateUser.find('select[name=gender_id]')
    UserTable.LoadSelect(
      select,
      result.data.genders,
      result.data.user.gender_id,
    )
    select = modalUpdateUser.find('select[name=phone_code]')
    UserTable.LoadSelect(
      select,
      result.data.countries,
      result.data.user.phone_code,
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

  if (data.status_id) {
    modalStatusUser.find('.modal-content').addClass('bg-gradient-danger')
    modalStatusUser.find('.modal-content').removeClass('bg-gradient-primary')
  } else {
    modalStatusUser.find('.modal-content').removeClass('bg-gradient-danger')
    modalStatusUser.find('.modal-content').addClass('bg-gradient-primary')
  }

  queryStatusUser.var.id = data.id
  queryStatusUser.var.status = data.status_id
}

function ButtonStatus() {
  modalStatusUser.find('.overlay').show()
  queryStatusUser.Send()
}
let queryStatusUser = new QueryAjax({
  url: '/accounts/users/status',
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

let modalAssignRoles = $('#modal-assign-roles')

// funtion open modal assign
function AssignRoles(data) {
  modalAssignRoles
    .find('.name_user')
    .text(data.first_name + ' ' + data.last_name)
  assignRolesTable.form.url = '/accounts/users/' + data.id + '/roles'
  SendRolesAssign.url = '/accounts/users/' + data.id + '/assign'
  assignRolesTable.refresh(false)
}

// table permissions
let structure_array = [' ', 'Nombre', 'Description']
var assignRolesTable = new tableGear(
  $('#assign-roles'),
  '/accounts/roles/_role_/permissions',
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
  url: '/accounts/roles/_role_/assign',
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
