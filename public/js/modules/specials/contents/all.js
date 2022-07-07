const settingEditor = {
  image: {
    class: SimpleImage,
    inlineToolbar: false,
    config: {
      placeholder: 'Ingresar la url',
    },
  },
  summary: {
    class: SummaryTop,
    inlineToolbar: false,
    config: {
      placeholder: 'Ingresar la url',
    },
  },
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

    editorContent.destroy()
    $('#editorjs').html()

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
