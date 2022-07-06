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
      notify(false, 'Error guardando el contenido:', error, 1)
      overlayContent.hide()
    })
})

function ActionSaveContent(data) {
  if(!data){
    notify(false, 'Error guardando el contenido:', error, 1)
    return false
  }

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
