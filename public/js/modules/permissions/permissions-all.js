let div = $('#tablePermissions')
let route = '/accounts/permissions/list'
let structure = [' ', 'Nombre', 'Description', 'Módulo', 'guard_name']

var permissionTable = new tableGear(div, route, structure)
permissionTable.filter.modules = ''
permissionTable.refresh(true)

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
  url: '/accounts/permissions/create',
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
