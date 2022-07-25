const settingEditor = {
  image: {
    class: EditorJsSimpleImage,
    inlineToolbar: false,
    config: {
      placeholder: '',
    },
  },
  summary: {
    class: EditorJsSummaryTop,
    inlineToolbar: false,
    config: {
      placeholder: 'Agrega un texto de resumen',
    },
  },
  embedHtml: {
    class: EmbedHtml,
    inlineToolbar: false,
    config: {
      placeholder: '',
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

var editorContent = null
function initEditorJs(data = null) {
  $('#editorjs').html('')

  editorContent = new EditorJS({
    holder: 'editorjs',
    tools: settingEditor,
    data: data ?? null,
    i18n: {
      messages: {
        ui: {
          blockTunes: {
            toggler: {
              'Click to tune': 'Click para ajustar',
              'or drag to move': 'o arrastra para mover',
            },
          },
          toolbar: {
            toolbox: {
              Add: 'Agregar',
            },
          },
        },
        toolNames: {
          Text: 'Texto',
          Heading: 'Títulos',
          List: 'Lista',
        },
        blockTunes: {
          delete: {
            Delete: 'Eliminar',
          },
          moveUp: {
            'Move up': 'Mover arriba',
          },
          moveDown: {
            'Move down': 'Mover abajo',
          },
        },
      },
    },
  })
}
