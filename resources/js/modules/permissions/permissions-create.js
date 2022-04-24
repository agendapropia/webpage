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
