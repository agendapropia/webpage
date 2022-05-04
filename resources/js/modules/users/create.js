let modalCreateUser = $('#modal-create-user')
let formCreateUser = $('form[name=form-create-user]')

function CreateUser() {
  UtilClearFormUi(formCreateUser)
  queryCreateUser.Send()
}

//Get data modal
let queryCreateUser = new QueryAjax({
  url: '/admin/accounts/users/create',
  method: 'GET',
  action: 'CreateUserModal',
  listTable: UserTable,
})
function CreateUserModal(status, result) {
  if (status) {
    LoadSelectUtil(
      modalCreateUser.find('select[name=gender_id]'),
      result.data.genders,
    )
    LoadSelectUtil(
      modalCreateUser.find('select[name=phone_code]'),
      result.data.countries,
    )
    LoadSelectUtil(
      modalCreateUser.find('select[name=location]'),
      [
        { id: 'es', name: 'Español' },
        { id: 'en', name: 'Ingles' },
      ],
      'es',
    )
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
