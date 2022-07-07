let divUpdate = $('#div-update-main')
let formUpdateMain = $('form[name=form-update-main]')
let buttonUpdateDetails = divUpdate.find('.special-btn-details')
let divUpdateDetails = divUpdate.find('.special-div-details')

let selectLanguage = divUpdate.find('select[name=language_id]')
let overlayContent = divUpdate.find('.overlay')

var editorContent = new EditorJS({
  holder: 'editorjs',
  tools: settingEditor,
})

//Funtion Modal Update
function ActionMainUpdate() {
  overlayContent.show()
  UtilClearFormUi(formUpdateMain)

  let slug = $('#slug').val()
  queryInitialUpdateMain.url = `/admin/specials/${slug}/contents/update`
  queryInitialUpdateMain.var.language_id = selectLanguage.val()
  queryInitialUpdateMain.Send()

  SaveContent.url = `/admin/specials/${slug}/contents`
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

    $('#editorjs').html()
    editorContent.destroy()

    if (
      result.data.content.content &&
      result.data.content.content != 'undefined'
    ) {
      editorContent = new EditorJS({
        holder: 'editorjs',
        tools: settingEditor,
        data: JSON.parse(decodeURIComponent(result.data.content.content)),
      })
    } else {
      editorContent = new EditorJS({
        holder: 'editorjs',
        tools: settingEditor,
      })
    }
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
