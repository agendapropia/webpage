const settingEditor = {
  image: {
    class: SimpleImage,
    inlineToolbar: false,
    config: {
      placeholder: '',
    },
  },
  summary: {
    class: SummaryTop,
    inlineToolbar: false,
    config: {
      placeholder: 'Agrega un texto de resumen',
    },
  },
  paragraph: {
    class: Paragraph,
    inlineToolbar: true,
    config: {
      placeholder:
        'Haga click en el (+) para agregar un texto, imágenes o recursos multimedia',
    },
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

var editorContent = null
function initEditorJs(data = null) {
  $('#editorjs').html('')

  editorContent = new EditorJS({
    holder: 'editorjs',
    tools: settingEditor,
    data: data ?? null,
  })
}

ActionMainUpdate()

// Autocomplete
let specialContents = new searchByAutocomplete(
  formCopyMain.find('.specialContents'),
  {
    params: [],
    url: '/admin/specials/contents/search-by-autocomplete',
    limitItems: 1,
    minimumCharactersToSearch: 1,
  },
)

buttonCopy.click(() => {
  modalCopyMain.modal('show')
  modalCopyOverlay.hide()
  specialContents.clearSelect()
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
