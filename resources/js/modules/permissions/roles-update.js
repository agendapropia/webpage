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
