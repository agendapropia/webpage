// Autocomplete
let articleContents = new searchByAutocomplete(
  formCopyMain.find('.articleContents'),
  {
    params: [],
    url: '/admin/articles/contents/search-by-autocomplete',
    limitItems: 1,
    minimumCharactersToSearch: 1,
  },
)

buttonCopy.click(() => {
  modalCopyMain.modal('show')
  modalCopyOverlay.hide()
  articleContents.clearSelect()
})

function ReplaceContent() {
  formCopyMain.find('input[name=language_id]').val(languageCurrent)
  modalCopyOverlay.show()
  ReplaceContentQuery.Send()
}

let ReplaceContentQuery = new QueryAjax({
  action: 'ReplaceContentAction',
  form: 'form-copy-main',
})
function ReplaceContentAction(status, result) {
  if (status && result.status) {
    notify(false, 'Contenido reemplazado', '', 2)
    ActionMainUpdate()
  } else {
    notify(false, 'Error guardando el contenido:', result.message, 1)
  }

  modalCopyMain.modal('hide')
  modalCopyOverlay.hide()
}
