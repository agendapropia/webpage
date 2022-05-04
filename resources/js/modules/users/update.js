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
