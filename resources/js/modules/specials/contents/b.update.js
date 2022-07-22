const divUpdate = $('#div-update-main')
const formUpdateMain = $('form[name=form-update-main]')
const buttonUpdateDetails = divUpdate.find('.special-btn-details')
const divUpdateDetails = divUpdate.find('.special-div-details')
const selectLanguage = divUpdate.find('select[name=language_id]')
const overlayContent = divUpdate.find('.overlay')

const formCopyMain = $('form[name=form-copy-main]')
const modalCopyMain = $('#modal-copy-main')
const modalCopyOverlay = modalCopyMain.find('.overlay')
const buttonCopy = divUpdate.find('.special-btn-copy')

var languageCurrent = 1
function ActionMainUpdate() {
  overlayContent.show()
  UtilClearFormUi(formUpdateMain)

  let slug = $('#slug').val()
  queryInitialUpdateMain.url = `/admin/specials/${slug}/contents/update`
  queryInitialUpdateMain.var.language_id = selectLanguage.val()
  queryInitialUpdateMain.Send()

  SaveContent.url = `/admin/specials/${slug}/contents`
  formCopyMain.attr('action', `/admin/specials/${slug}/contents/copies`)
  SaveContent.var.language_id = selectLanguage.val()
}

//Get data modal
let queryInitialUpdateMain = new QueryAjax({
  url: '/admin/specials/{slug}/contents/update',
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
      initEditorJs(JSON.parse(decodeURIComponent(result.data.content.content)))
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
