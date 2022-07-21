let modalSpecialUsers = $('#modal-special-users')
let formCreateSpecialUsers = modalSpecialUsers.find(
  'form[name=form-special-users]',
)

let divUser = $('#table-special-users')
let routeUser = '/admin/specials/users/list'
let structureUser = [' ', 'Nombre', 'Role']

var TableSpecialUsers = new tableGear(divUser, routeUser, structureUser)
TableSpecialUsers.modalSelect = modalSpecialUsers
TableSpecialUsers.tablePaginate = false
TableSpecialUsers.filter.row = 200

function ActionModalUsers(data) {
  UtilClearFormUi(formCreateSpecialUsers)

  modalSpecialUsers.find('.modal-subtitle').text(` (${data.name})`)
  TableSpecialUsers.filter.id = data.id
  formCreateSpecialUsers.find('input[name=special_id]').val(data.id)

  TableSpecialUsers.refresh(false)
  userSelectUpdate.clearSelect()
  QueryModalDataUsers.Send()
}
// Autocomplete
let userSelectUpdate = new searchByAutocomplete(
  formCreateSpecialUsers.find('.usersSelect'),
  {
    params: [],
    url: '/admin/accounts/users/search-by-autocomplete',
    limitItems: 1,
    minimumCharactersToSearch: 1,
  },
)

/** --------- METHOD CREATE --------- */
function QueryModalDataUsersAction(){
  modalSpecialUsers.find('.overlay').show()
  QueryModalCreateUsers.Send()
}
let QueryModalDataUsers = new QueryAjax({
  url: '/admin/specials/roles',
  method: 'GET',
  action: 'ActionModalDataUsers',
  listTable: TableSpecialUsers,
})
function ActionModalDataUsers(status, result) {
  if (status) {
    LoadSelectUtil(
      formCreateSpecialUsers.find('select[name=special_role_id]'),
      result.data.roles,
    )
  }
}
let QueryModalCreateUsers = new QueryAjax({
  form: 'form-special-users',
  action: 'ActionModalCreateUsers',
  loaderSelected: modalSpecialUsers.find('.overlay-modal'),
})
function ActionModalCreateUsers(status, result) {
  modalSpecialUsers.find('.overlay').hide()
  if (!status) {
    return false
  }

  if (result.status) {
    notify(false, 'Usuario asociado', 'Operación realizada exitosamente', 2)
    QueryModalCreateUsers.FormClose(false)
    TableSpecialUsers.refresh(false)
  } else {
    notify(false, 'Usuario ya esta asociado', '', 1)
    QueryModalCreateUsers.FormClose(false)
  }

  userSelectUpdate.clearSelect()
}

/** --------- METHOD DELETE --------- */

function ButtonModalDeleteUsers(element) {
  let id = $(element).parent().parent().data('id')
  QueryModalDeleteUsers.var.id = id
  QueryModalDeleteUsers.Send()
}

let QueryModalDeleteUsers = new QueryAjax({
  url: '/admin/specials/users',
  method: 'DELETE',
  action: 'ActionModalDeleteUsers',
  listTable: TableSpecialUsers,
})
function ActionModalDeleteUsers(status) {
  if (!status) {
    return false
  }
  notify(false, 'Usuario eliminado', 'Operación realizada exitosamente', 1)
  TableSpecialUsers.refresh(false)
}
