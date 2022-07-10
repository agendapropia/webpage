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
