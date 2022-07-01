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
