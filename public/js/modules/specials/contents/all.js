const settingEditor = {
  image: {
    class: SimpleImage,
    inlineToolbar: true,
    config: {
      placeholder: 'Ingresar la url',
    },
  },
  table: Table,
  paragraph: {
    class: Paragraph,
    inlineToolbar: true,
  },
  Marker: {
    class: Marker,
    shortcut: 'CMD+SHIFT+M',
  },
  header: {
    class: Header,
    shortcut: 'CMD+SHIFT+H',
  },
  raw: RawTool,
  checklist: {
    class: Checklist,
    inlineToolbar: true,
  },
  list: {
    class: List,
    inlineToolbar: true,
    config: {
      defaultStyle: 'unordered',
    },
  },
  embed: {
    class: Embed,
    config: {
      services: {
        youtube: true,
        coub: true,
        codepen: {
          regex: /https?:\/\/codepen.io\/([^\/\?\&]*)\/pen\/([^\/\?\&]*)/,
          embedUrl:
            'https://codepen.io/<%= remote_id %>?height=300&theme-id=0&default-tab=css,result&embed-version=2',
          html:
            "<iframe height='300' scrolling='no' frameborder='no' allowtransparency='true' allowfullscreen='true' style='width: 100%;'></iframe>",
          height: 300,
          width: 1200,
          id: (groups) => groups.join('/embed/'),
        },
      },
    },
  },
}

let buttonSaveContent = document.getElementById('special-btn-save')
buttonSaveContent.addEventListener('click', function () {
  overlayContent.show()
  editorContent
    .save()
    .then((outputData) => {
      ActionSaveContent(outputData)
    })
    .catch((error) => {
      notify(false, 'Saving failed:', error, 1)
      overlayContent.hide()
    })
})

function ActionSaveContent(data) {
  let content = JSON.stringify(data)
  SaveContent.var.content = encodeURIComponent(content)
  SaveContent.Send()
}

let SaveContent = new QueryAjax({
  url: '/admin/specials/${slug}/contents',
  method: 'PUT',
  action: 'AfterSaveContent',
})
function AfterSaveContent(status) {
  if (status) {
    notify(false, 'Contenido Actualizado', '', 2)
  }
  overlayContent.hide()
}

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

    editorContent.destroy()
    $('#editorjs').html()

    if (result.data.content.content) {
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
