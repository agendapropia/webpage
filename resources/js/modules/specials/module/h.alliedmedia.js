let modalSpecialAlliedMedia = $('#modal-special-alliedmedia')
let formCreateSpecialAlliedMedia = modalSpecialAlliedMedia.find(
  'form[name=form-special-alliedmedia]',
)

let divAlliedMedia = $('#table-special-alliedmedia')
let routeAlliedMedia = '/admin/specials/allied-media/internal/list'
let structureAlliedMedia = [' ', 'Nombre', 'Role']

var TableSpecialAlliedMedia = new tableGear(divAlliedMedia, routeAlliedMedia, structureAlliedMedia)
TableSpecialAlliedMedia.modalSelect = modalSpecialAlliedMedia
TableSpecialAlliedMedia.tablePaginate = false
TableSpecialAlliedMedia.filter.row = 200

function ActionModalAlliedMedia(data) {
  UtilClearFormUi(formCreateSpecialAlliedMedia)

  modalSpecialAlliedMedia.find('.modal-subtitle').text(` (${data.name})`)
  TableSpecialAlliedMedia.filter.id = data.id
  formCreateSpecialAlliedMedia.find('input[name=special_id]').val(data.id)

  TableSpecialAlliedMedia.refresh(false)
  alliedmediaSelectUpdate.clearSelect()
  QueryModalDataAlliedMedia.Send()
}

// Autocomplete
let alliedmediaSelectUpdate = new searchByAutocomplete(
  formCreateSpecialAlliedMedia.find('.alliedmediaSelect'),
  {
    params: [],
    url: '/admin/specials/allied-media/search-by-autocomplete',
    limitItems: 1,
    minimumCharactersToSearch: 1,
  },
)

/** --------- METHOD CREATE --------- */
function QueryModalDataAlliedMediaAction(){
  modalSpecialAlliedMedia.find('.overlay').show()
  QueryModalCreateAlliedMedia.Send()
}

let QueryModalDataAlliedMedia = new QueryAjax({
  url: '/admin/specials/allied-media/internal/roles',
  method: 'GET',
  action: 'ActionModalDataAlliedMedia',
  listTable: TableSpecialAlliedMedia,
})
function ActionModalDataAlliedMedia(status, result) {
  if (status) {
    LoadSelectUtil(
      formCreateSpecialAlliedMedia.find('select[name=special_allied_media_role_id]'),
      result.data.roles,
    )
  }
}

let QueryModalCreateAlliedMedia = new QueryAjax({
  form: 'form-special-alliedmedia',
  action: 'ActionModalCreateAlliedMedia',
  loaderSelected: modalSpecialAlliedMedia.find('.overlay-modal'),
})
function ActionModalCreateAlliedMedia(status, result) {
  modalSpecialAlliedMedia.find('.overlay').hide()

  if (!status) {
    return false
  }

  if (result.status) {
    notify(false, 'Medio aliado asociado', 'Operación realizada exitosamente', 2)
    QueryModalCreateAlliedMedia.FormClose(false)
    TableSpecialAlliedMedia.refresh(false)
  } else {
    notify(false, 'Medio aliado ya esta asociado', '', 1)
    QueryModalCreateAlliedMedia.FormClose(false)
  }

  alliedmediaSelectUpdate.clearSelect()
}

/** --------- METHOD DELETE --------- */
function ButtonModalDeleteAlliedMedia(element) {
  let id = $(element).parent().parent().data('id')
  QueryModalDeleteAlliedMedia.var.id = id
  QueryModalDeleteAlliedMedia.Send()
}

let QueryModalDeleteAlliedMedia = new QueryAjax({
  url: '/admin/specials/allied-media/internal',
  method: 'DELETE',
  action: 'ActionModalDeleteAlliedMedia',
  listTable: TableSpecialAlliedMedia,
})
function ActionModalDeleteAlliedMedia(status) {
  if (!status) {
    return false
  }
  notify(false, 'Usuario eliminado', 'Operación realizada exitosamente', 1)
  TableSpecialAlliedMedia.refresh(false)
}
