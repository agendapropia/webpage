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
