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
