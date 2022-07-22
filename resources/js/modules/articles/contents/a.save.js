let buttonSaveContent = document.getElementById('article-btn-save')
buttonSaveContent.addEventListener('click', function () {
  overlayContent.show()
  editorContent
    .save()
    .then((outputData) => {
      ActionSaveContent(outputData)
    })
    .catch((error) => {
      notify(false, 'Error guardando el contenido:', error, 1)
      overlayContent.hide()
    })
})

function ActionSaveContent(data) {
  if (!data) {
    notify(false, 'Error guardando el contenido:', error, 1)
    return false
  }

  let content = JSON.stringify(data)
  SaveContent.var.content = encodeURIComponent(content)
  SaveContent.var.title = formUpdateMain.find('input[name=title]').val()
  SaveContent.var.subtitle = formUpdateMain.find('input[name=subtitle]').val()
  SaveContent.var.summary = formUpdateMain.find('textarea[name=summary]').val()
  SaveContent.var.status_id = formUpdateMain
    .find('select[name=status_id]')
    .val()
  SaveContent.Send()
}

let SaveContent = new QueryAjax({
  url: '/admin/articles/${slug}/contents',
  method: 'PUT',
  action: 'AfterSaveContent',
})
function AfterSaveContent(status) {
  if (status) {
    notify(false, 'Contenido Actualizado', '', 2)
  }
  overlayContent.hide()
}
