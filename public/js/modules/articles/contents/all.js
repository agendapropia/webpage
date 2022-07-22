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

const divUpdate = $('#div-update-main')
const formUpdateMain = $('form[name=form-update-main]')
const buttonUpdateDetails = divUpdate.find('.article-btn-details')
const divUpdateDetails = divUpdate.find('.article-div-details')
const selectLanguage = divUpdate.find('select[name=language_id]')
const overlayContent = divUpdate.find('.overlay')

const formCopyMain = $('form[name=form-copy-main]')
const modalCopyMain = $('#modal-copy-main')
const modalCopyOverlay = modalCopyMain.find('.overlay')
const buttonCopy = divUpdate.find('.article-btn-copy')

var languageCurrent = 1

function ActionMainUpdate() {
  overlayContent.show()
  UtilClearFormUi(formUpdateMain)

  let slug = $('#slug').val()
  queryInitialUpdateMain.url = `/admin/articles/${slug}/contents/update`
  queryInitialUpdateMain.var.language_id = selectLanguage.val()
  queryInitialUpdateMain.Send()

  SaveContent.url = `/admin/articles/${slug}/contents`
  formCopyMain.attr('action', `/admin/articles/${slug}/contents/copies`)
  SaveContent.var.language_id = selectLanguage.val()
}

//Get data modal
let queryInitialUpdateMain = new QueryAjax({
  url: '/admin/articles/{slug}/contents/update',
  method: 'GET',
  action: 'UpdateActionModal',
})
function UpdateActionModal(status, result) {
  if (status && result.status) {
    UtilFormClose(formUpdateMain)
    LoadFormInputs(divUpdate, result.data.content)
    formUpdateMain
      .find('select[name=status_id]')
      .val(result.data.content.status_id)

    languageCurrent = result.data.content.language_id
    if (
      result.data.content.content &&
      result.data.content.content != 'undefined'
      ) {
      initEditorJs(JSON.parse(result.data.content.content))
    } else {
      initEditorJs()
    }
  } else {
    modalCopyMain.modal('show')
    selectLanguage.val(languageCurrent)
    modalCopyOverlay.hide()
  }
  overlayContent.hide()
}

selectLanguage.change(function () {
  ActionMainUpdate()
})

buttonUpdateDetails.click(() => {
  let status = $(this).attr('data-status')
  if (!status) {
    $(this).attr('data-status', true)
    divUpdateDetails.removeClass('hide')

    buttonUpdateDetails.addClass('button-detail-disabled')
    buttonUpdateDetails.find('.fa').removeClass('fa-level-down')
    buttonUpdateDetails.find('.fa').addClass('fa-level-up')
  } else {
    $(this).attr('data-status', false)
    divUpdateDetails.addClass('hide')
    buttonUpdateDetails.removeClass('button-detail-disabled')

    buttonUpdateDetails.find('.fa').addClass('fa-level-down')
    buttonUpdateDetails.find('.fa').removeClass('fa-level-up')
  }
})
ActionMainUpdate()

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
