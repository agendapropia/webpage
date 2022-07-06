let divUpdate = $('#div-update-main')
let formUpdateMain = $('form[name=form-update-main]')

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

// //Send Update Data Modal
// let ActionMainUpdateSend = new QueryAjax({
//   form: 'form-update-main',
//   action: 'FunctionActionUpdateMain',
// })
// function FunctionActionUpdateMain(status) {
//   if (status) {
//     notify(
//       false,
//       'Medio Aliado Actualizado',
//       'Operación realizada exitosamente',
//       2,
//     )
//     ActionMainUpdateSend.FormClose()
//     TableMain.refresh()
//   }
// }

selectLanguage.change(function () {
  ActionMainUpdate()
})

ActionMainUpdate()
