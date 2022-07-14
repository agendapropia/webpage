let modalArticleUsers = $('#modal-article-users')
let formCreateArticleUsers = modalArticleUsers.find(
  'form[name=form-article-users]',
)

let divUser = $('#table-article-users')
let routeUser = '/admin/articles/users/list'
let structureUser = [' ', 'Nombre', 'Role']

var TableArticleUsers = new tableGear(divUser, routeUser, structureUser)
TableArticleUsers.modalSelect = modalArticleUsers
TableArticleUsers.tablePaginate = false
TableArticleUsers.filter.row = 200

function ActionModalUsers(data) {
  UtilClearFormUi(formCreateArticleUsers)

  modalArticleUsers.find('.modal-subtitle').text(` (${data.name})`)
  TableArticleUsers.filter.id = data.id
  formCreateArticleUsers.find('input[name=article_id]').val(data.id)

  TableArticleUsers.refresh(false)
  userSelectUpdate.clearSelect()
  QueryModalDataUsers.Send()
}
// Autocomplete
let userSelectUpdate = new searchByAutocomplete(
  formCreateArticleUsers.find('.usersSelect'),
  {
    params: [],
    url: '/admin/accounts/users/search-by-autocomplete',
    limitItems: 1,
    minimumCharactersToSearch: 1,
  },
)

/** --------- METHOD CREATE --------- */

let QueryModalDataUsers = new QueryAjax({
  url: '/admin/articles/roles',
  method: 'GET',
  action: 'ActionModalDataUsers',
  listTable: TableArticleUsers,
})
function ActionModalDataUsers(status, result) {
  if (status) {
    LoadSelectUtil(
      formCreateArticleUsers.find('select[name=article_role_id]'),
      result.data.roles,
    )
  }
}
let QueryModalCreateUsers = new QueryAjax({
  form: 'form-article-users',
  action: 'ActionModalCreateUsers',
  loaderSelected: modalArticleUsers.find('.overlay-modal'),
})
function ActionModalCreateUsers(status, result) {
  if (!status) {
    return false
  }

  if (result.status) {
    notify(false, 'Usuario asociado', 'Operación realizada exitosamente', 2)
    QueryModalCreateUsers.FormClose(false)
    TableArticleUsers.refresh(false)
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
  url: '/admin/articles/users',
  method: 'DELETE',
  action: 'ActionModalDeleteUsers',
  listTable: TableArticleUsers,
})
function ActionModalDeleteUsers(status) {
  if (!status) {
    return false
  }
  notify(false, 'Usuario eliminado', 'Operación realizada exitosamente', 1)
  TableArticleUsers.refresh(false)
}
