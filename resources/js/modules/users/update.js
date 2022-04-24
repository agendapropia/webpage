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
