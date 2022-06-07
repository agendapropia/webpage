let modalAssignPermissions = $('#modal-assign-permissions')
let formAssignPermissions = $('form[name=form-assign-permissions]')

// funtion open modal assign
function AssignPermissions(data) {
  modalAssignPermissions.find('.name_role').text(data.name)
  assignPermissionTable.form.url = '/admin/accounts/roles/' + data.id + '/permissions'
  SendPermissionAssign.url = '/admin/accounts/roles/' + data.id + '/assign'
  assignPermissionTable.refresh(false)
}

// table permissions
let structure_array = [' ', 'Nombre', 'Description', 'Módulo']
var assignPermissionTable = new tableGear(
  $('#assign-permissions'),
  '/admin/accounts/roles/_role_/permissions',
  structure_array,
  'selectedDataPermission',
)
assignPermissionTable.tablePaginate = false
assignPermissionTable.filter.row = 200
assignPermissionTable.modalSelect = modalAssignPermissions

function selectedDataPermission(result) {
  assignPermissionTable.CheckboxSelect(false)
  assignPermissionTable.CheckboxArraySelect('role', 1)
}

// preparate data
function SendDataPermissionsRoles() {
  let remove = []
  let add = []

  $.each(assignPermissionTable.data_complete.data.data, function (elemt, data) {
    if (data.role == 1) {
      if (jQuery.inArray(data.id, assignPermissionTable.checks) == -1) {
        remove.push(data.id)
      }
    } else {
      if (jQuery.inArray(data.id, assignPermissionTable.checks) != -1) {
        add.push(data.id)
      }
    }
  })

  if (remove.length || add.length) {
    SendPermissionAssign.var.remove = remove
    SendPermissionAssign.var.add = add
    SendPermissionAssign.Send()
  } else {
    SendPermissionAssign.FormClose()
  }
}

//Send assign permissions
let SendPermissionAssign = new QueryAjax({
  url: '/admin/accounts/roles/_role_/assign',
  method: 'POST',
  action: 'FinishAssignPermission',
  listTable: assignPermissionTable,
})
function FinishAssignPermission(status, data) {
  if (status) {
    notify(false, 'Permisos Actualizado', 'Operación realizada exitosamente', 2)
    SendPermissionAssign.FormClose()
  }
}

// create permission
let modalCreatePermissions = $('#modal-create-permissions')
let formCreatePermissions = $('form[name=form-create-permissions]')

function CreatePermissions() {
  permissionTable.ModalClearForm(formCreatePermissions)
  getDataPermission.action = 'setDataModalCreatePermission'
  getDataPermission.Send()
}

// load data modal create
let getDataPermission = new QueryAjax({
  url: '/admin/accounts/permissions/create',
  method: 'GET',
  listTable: permissionTable,
})
function setDataModalCreatePermission(status, result) {
  if (status) {
    let select = modalCreatePermissions.find('select[name=module_id]')
    permissionTable.LoadSelect(select, result.data.modules)
  }
}

// send data modal create
let SendCreatePermission = new QueryAjax({
  form: 'form-create-permissions',
  action: 'PermissionCreateAction',
  listTable: permissionTable,
})
function PermissionCreateAction(status, data) {
  if (status) {
    notify(false, 'Permiso creado', 'Role creado exitosamente.', 2)
    SendCreatePermission.FormClose()
    permissionTable.refresh()
  }
}

let div = $('#tablePermissions')
let route = '/admin/accounts/permissions/list'
let structure = [' ', 'Nombre', 'Description', 'Módulo', 'guard_name']

var permissionTable = new tableGear(div, route, structure)
permissionTable.filter.modules = ''
permissionTable.refresh(true)

// update permissions
let modalUpdatePermissions = $('#modal-update-permissions')
let formUpdatePermissions = $('form[name=form-update-permissions]')

//Funtion Modal Update
function UpdatePermissions(data) {
  getDataPermission.action = 'setDataModalCreateUpdatePermission'
  getDataPermission.Send()
}
function setDataModalCreateUpdatePermission(status, result) {
  if (status) {
    permissionTable.ModalClearForm(formUpdatePermissions)
    let select = modalUpdatePermissions.find('select[name=module_id]')
    LoadFormInputs(modalUpdatePermissions, permissionTable.dataSelect)
    permissionTable.LoadSelect(
      select,
      result.data.modules,
      permissionTable.dataSelect.module_id,
    )
    formUpdatePermissions
      .find('input[name=id]')
      .val(permissionTable.dataSelect.id)
  }
}

//Send Update Data Modal
let SendPermissionsUpdate = new QueryAjax({
  form: 'form-update-permissions',
  action: 'PermissionUpdateAction',
  listTable: permissionTable,
})
function PermissionUpdateAction(status, data) {
  if (status) {
    notify(false, 'Permiso Actualizado', 'Operación realizada exitosamente', 2)
    SendPermissionsUpdate.FormClose()
    permissionTable.refresh()
  }
}

let modalCreateRoles = $('#modal-create-roles')
let formCreateRoles = $('form[name=form-create-role]')

function CreateRole() {
  roleTable.ModalClearForm(formCreateRoles)
}

//Send data modal
let SendCreateRole = new QueryAjax({
  form: 'form-create-role',
  action: 'RoleCreateAction',
  listTable: roleTable,
})
function RoleCreateAction(status, data) {
  if (status) {
    notify(false, 'Role creado', 'Role creado exitosamente.', 2)
    SendCreateRole.FormClose()
    roleTable.refresh()
  }
}

let div = $('#tableRoles')
let route = '/admin/accounts/roles/list'
let structure = [' ', 'Nombre', 'Description', 'guard_name']

var roleTable = new tableGear(div, route, structure)
roleTable.filter.status = ''
roleTable.refresh(true)

//Update Roles
let modalUpdateRoles = $('#modal-update-roles')
let formUpdateRoles = $('form[name=form-update-roles]')

//Funtion Modal Update
function UpdateRoles(data) {
  roleTable.ModalClearForm(formUpdateRoles)
  LoadFormInputs(modalUpdateRoles, data)
  formUpdateRoles.find('input[name=id]').val(data.id)
}

//Send Update Data Modal
let SendRolesUpdate = new QueryAjax({
  form: 'form-update-roles',
  action: 'RolesUpdateAction',
  listTable: roleTable,
})
function RolesUpdateAction(status, data) {
  if (status) {
    notify(false, 'Role Actualizado', 'Operación realizada exitosamente', 2)
    SendRolesUpdate.FormClose()
    roleTable.refresh()
  }
}
