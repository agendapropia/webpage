/**
 * REQUIRE
 * sortable {url} https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js
 *
 * INCLUDE
 * -> Headers
 * <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 * <link rel="stylesheet" href="{{ asset('/vendor/plugins/filesS3/PublicS3.css') }}" type="text/css" />
 *
 * ->footer
 * <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 * <script src="{{ asset('/vendor/plugins/filesS3/PublicS3.js') }}" type="text/javascript"></script>
 */

// Variables GLOBALES
var pathArray = location.href.split('/')
var protocol = pathArray[0]
var host = pathArray[2]
var APP_URL = protocol + '//' + host
var URL_IMG = APP_URL + '/img/app/'

class formFiles {
  constructor(url, data) {
    this.url = url
    this.data = data
  }
}
class varQuery {
  constructor(id) {
    this.id = id
    this.textarea = ''
    this.type = ''
    this.files = []
    this._token = $('meta[name=csrf-token]').attr('content')
  }
}

// Variables de configuracion IMPORTANTES
class updloadS3 {
  constructor(content, options) {
    this.content = content
    this.state = 1
    this.data = []
    this.dataDelete = []
    this.load = 0
    this.number = 0
    this.altFunction = false
    this.reload = true

    this.id = 0
    this.url = ''
    this.borderField = true

    this.typeFile = 1
    this.sizeFile = 100

    this.send = content.find('.btn-primary')
    this.listFiles = content.find('.upload-s3-list')
    this.imagen = content.find('.btn-upload')
    this.textarea = content.find('textarea[name=content]')
    this.checkbox = content.find('input[name=resp_public]')
    this.inputFile = content.find('input[name=file]')
    this.template = $('#template-file')
    this.loading = content.find('.loading')

    let cont = this
    $.each(options, function (key, value) {
      cont[key] = value
    })

    this.form = new formFiles(this.url, '')
    this.variables = new varQuery(this.id)
    this.xhr = ''
    this.statusMove = false

    this.url_uploadFile = '/uploadfiles_s3'
    this.url_removeFile = '/destroyfiles_s3'
    this.files_url = 'https://s3-us-west-1.amazonaws.com/germith/files/photos/'

    this.textarea.keyup(function () {
      cont.changeTextarea(this)
    })
    this.send.click(function () {
      cont.sendQuery(this)
    })
    this.imagen.click(function () {
      cont.inputFile.click()
    })
    this.inputFile.change(function () {
      cont.changeInputFile(this)
    })
    this.checkbox.change(function () {
      cont.changeCheckbox()
    })

    this.move()
    this.btnSend(true)

    this.loading.hide()
  }
  loadData(data, id) {
    this.variables.id = id

    let cont = this
    this.listFiles.find('li:not(.ui-state-disabled)').remove()
    this.data = []
    this.dataDelete = []

    $.each(data, function (key, value) {
      value.ext = value.name.substring(value.name.lastIndexOf('.'))
      value['form_d'] = 'f_' + value.id
      value['cont'] = value.id

      let typeFile = TypeFile(value.ext)

      add_file(cont, value, 2 + typeFile, value.name_tmp)

      cont.data.push(
        new filesItem(
          value.id,
          true,
          value.name,
          value.name_tmp,
          0,
          value.ext,
          2,
          typeFile,
        ),
      )

      cont.load++
    })

    this.orderData()
    this.btnSend(true)
  }
  move() {
    let cont = this

    this.listFiles.sortable({
      items: 'li:not(.ui-state-disabled)',
      revert: true,
      opacity: 0.6,
      cursor: 'move',
      update: function () {
        cont.orderData()
        cont.statusMove = true
        cont.validateMove()
      },
    })
  }
  orderData() {
    let cont = this
    let list = this.listFiles.find('li:not(.ui-state-disabled)')
    let item = 1

    $.each(list, function (key, value) {
      let id_li = $(value).attr('data-id')
      let index = cont.searchData(id_li, 'id')

      cont.data[index].order = item
      $(value).attr('data-order', item)

      item++
    })
  }
  searchData(value, index) {
    let item = null
    $.each(this.data, function (key, element) {
      if (element[index] == value) {
        item = key
      }
    })
    return item
  }
  stateXhr() {
    this.xhr && this.xhr.readyState != 4 ? this.xhr.abort() : null
  }
  updateForm() {
    let form = this.variables
    let data_send = '',
      separ = ''

    $.each(form, function (key, value) {
      data_send += separ + '' + key + '=' + value
      separ = '&'
    })
    this.form.data = data_send
  }
  sendQuery() {
    this.optionDisabled(true)
    this.variables.files = JSON.stringify(this.data)
    this.variables.files_delete = JSON.stringify(this.dataDelete)
    this.updateForm()

    let cont = this
    this.stateXhr()

    this.loading.show()

    this.xhr = $.post(this.form.url, this.form.data, function (result) {
      if (cont.reload) {
        cont.listFiles.find('li:not(.ui-state-disabled)').remove()
        cont.data = []
        cont.dataDelete = []
        cont.load = 0
        cont.number = 0
        cont.checkbox.prop('checked', false)
        cont.textarea.val('')
        cont.borderField ? cont.borderFiles() : null
      }
      cont.optionDisabled(false)
      cont.btnSend(true)

      cont.altFunction ? self[cont.altFunction](result) : null

      cont.loading.hide()
    }).fail(function (result) {
      cont.loading.hide()
      list_error(this, result) // Incomplete
    })
  }
  validate(state = false, id = 0) {
    let loanding = 0
    this.data.forEach(function (elemento, indice, array) {
      state && elemento.id == id && elemento.type == 1
        ? (elemento.state = true)
        : null
      !elemento.state && elemento.type == 1 ? loanding++ : null
    })

    loanding > 0 ? this.btnSend(true) : this.btnSend(false)

    this.borderField ? this.borderFiles() : null
  }
  validateMove() {
    let loanding = 0
    this.data.forEach(function (elemento, indice, array) {
      !elemento.state ? loanding++ : null
    })

    if (loanding == 0)
      !this.statusMove ? this.btnSend(true) : this.btnSend(false)
  }
  validateRemove(state = false) {
    if (state) {
      let loanding = 0
      this.data.forEach(function (elemento, indice, array) {
        !elemento.state ? loanding++ : null
      })

      if (loanding == 0)
        !this.data.length && !this.textarea.val()
          ? this.btnSend(true)
          : this.btnSend(false)
    } else {
      !this.data.length && !this.textarea.val()
        ? this.btnSend(true)
        : this.btnSend(false)
    }
    this.borderField ? this.borderFiles() : null
    this.orderData()
  }
  optionDisabled(state) {
    this.send.prop('disabled', state)
    this.imagen.prop('disabled', state)
    this.textarea.prop('disabled', state)
    this.checkbox.prop('disabled', state)

    state
      ? this.listFiles.find('.delete').hide()
      : this.listFiles.find('.delete').show()
  }
  borderFiles() {
    this.data.length == 0
      ? this.listFiles.removeClass('border-dashed')
      : this.listFiles.addClass('border-dashed')
  }
  btnSend(state) {
    this.send.prop('disabled', state)
  }
  changeCheckbox() {
    this.variables.type = this.checkbox.is(':checked')
  }
  stateCheckbox() {
    return this.checkbox.is(':checked')
  }
  changeTextarea(element) {
    areatextHeight(element)
    this.validateRemove(true)
    this.variables.textarea = this.textarea.val()
  }
  changeInputFile(element) {
    for (var i = 0; i < element.files.length; ++i) {
      this.number++
      var file = element.files[i]
      this.uploadFile(file, this.number)
    }
    this.inputFile.val('')
  }
  uploadFile(file, numb) {
    var data = {
      id: numb,
      file: file,
      form_d: 'f_' + numb,
      cont: numb,
      name: file.name.toString(),
      size: file.size,
      ext: file.name.substring(file.name.lastIndexOf('.')),
      type: 1,
    }

    var state_file = file_type(data.ext, this.typeFile, data.name)
    var state_size = file_size(data.size, this.sizeFile, data.name)
    data.type = state_file

    if (state_file && state_size) {
      this.listFiles.show()
      //Generamos el nombre tmp para el almacenar en el servidor
      var ramdom_name = name_ramdom(state_file)

      add_file(this, data, state_file, ramdom_name + data.ext)

      var percent
      var form = $('#' + data.form_d)
      var formdata = new FormData()

      formdata.append('file', data.file)
      formdata.append('file_name', ramdom_name)
      formdata.append('file_type', state_file)
      formdata.append('_token', $('meta[name=csrf-token]').attr('content'))

      this.load++
      this.data.push(
        new filesItem(
          data.id,
          false,
          data.name,
          ramdom_name + data.ext,
          data.size,
          data.ext,
          1,
          state_file,
        ),
      )

      this.validate()
      let cont = this

      function upload_data() {
        var request = new XMLHttpRequest() //request
        request.upload.addEventListener('progress', function (e) {
          percent = Math.round((e.loaded / e.total) * 100)
          form
            .find('.progress-bar')
            .width(percent + '%')
            .html(percent + '%')
        })

        //progress completed load event
        request.addEventListener('load', function (e) {
          if (e.currentTarget.status == 500) {
            form.find('.cont').show()
            form.find('.error').show()
          } else if (e.total == 0) {
            if (data.type == 1) {
              form.find('.cont').hide()

              form
                .find('.image')
                .css(
                  'background-image',
                  'url(' +
                    cont.files_url +
                    'thumbnails/' +
                    $(form).data('name') +
                    ')',
                )
            } else {
              form.find('.download').show()
              form.find('.text').addClass('name_file')
            }
			form.find('.progress').hide()
            cont.validate(true, data.id)
          }

          cont.orderData()
        })

        request.addEventListener('error', function (e) {
          form.find('.error').show()
        })

        request.open('post', APP_URL + cont.url_uploadFile)
        request.send(formdata)

        form.find('.btn-delete').click(function (e) {
          e.preventDefault()
          request.abort()

          let id = form.data('id')
          let name = form.data('name')
          form.remove()

          cont.data.forEach(function (elemento, indice, array) {
            elemento.state ? cont.delete_file_arc(name) : null
            elemento.id == id ? cont.data.splice(indice, 1) : null
          })

          cont.validateRemove(true)
        })
      }

      upload_data()

      form.find('.preload').click(function (e) {
        upload_data()
        form.find('.error').hide()
        form.find('.cont').show()
        percent = 0
        form
          .find('.progress-bar')
          .width(percent + '%')
          .html(percent + '%')
      })
    }
  }
  delete_file_arc(name_file) {
    let cont = this
    $.ajax({
      url: APP_URL + cont.url_removeFile,
      type: 'POST',
      timeout: 100000,
      data: {
        name: name_file,
        type: 1,
        _token: $('meta[name=csrf-token]').attr('content'),
      },
      error: function () {},
      success: function (result) {},
    })
  }
}

/**
 *
 */
class filesItem {
  constructor(id, state, name, name_tmp, size, ext, type, type_file) {
    this.id = id
    this.state = state
    this.name = name
    this.name_tmp = name_tmp
    this.size = size
    this.ext = ext
    this.type = type
    this.type_file = type_file
  }
}

/**
 * Function Download
 */
// let query = new query_API('/download_s3', 'POST', 'downloadS3');

// function getFileS3(id, type=1)
// {
// 	notify(false, 'Descargando...', '', 4)
// 	query.variables.type = type;
// 	query.variables.id = id;
// 	query.update()
// }
// function downloadS3(result)
// {
// 	document.getElementById("OpenPage").href = result.data
// 	document.getElementById("OpenPage").click()
// 	return false;
// }
/** End Download */

/**
 * Function Download
 */
// let queryPub = new query_API('/download_s3_public', 'POST', 'downloadS3');

// function getFileS3Pub(name)
// {
// 	notify(false, 'Descargando...', '', 4)
// 	queryPub.variables.id = name;
// 	queryPub.update()
// }
// /** End Download */

var file_ico = {
  '.zip': 'ico_archivo.png',
  '.rar': 'ico_archivo.png',
  '.ppt': 'ico_point.png',
  '.pptx': 'ico_point.png',
  '.pps': 'ico_point.png',
  '.doc': 'ico_word.png',
  '.docx': 'ico_word.png',
  '.accdb': 'ico_acces.png',
  '.ccdb': 'ico_acces.png',
  '.mdb': 'ico_acces.png',
  '.xlsx': 'ico_excel.png',
  '.xls': 'ico_excel.png',
  '.xlsm': 'ico_excel.png',
  '.xlsb': 'ico_excel.png',
  '.pdf': 'ico_pdf.png',
  '.PDF': 'ico_pdf.png',
}

var file_name = {
  '.JPG': 'Imagen',
  '.jpg': 'Imagen',
  '.jpeg': 'Imagen',
  '.gif': 'Imagen',
  '.PNG': 'Imagen',
  '.png': 'Imagen',
  '.zip': 'Archivo comprimido',
  '.rar': 'Archivo comprimido',
  '.ppt': 'Power Point',
  '.pptx': 'Power Point',
  '.pps': 'Power Point',
  '.doc': 'Documento de word',
  '.docx': 'Documento de word',
  '.accdb': 'Base datos Access',
  '.ccdb': 'Base datos Access',
  '.mdb': 'Base datos Access',
  '.xlsx': 'Documento de excel',
  '.xls': 'Documento de excel',
  '.xlsm': 'Documento de excel',
  '.xlsb': 'Documento de excel',
  '.pdf': 'Documento PDF',
  '.PDF': 'Documento PDF',
}

//name ramdom
function name_ramdom(type) {
  var rand = function () {
    return Math.random().toString(36).substr(2)
  }
  var date = new Date()
  if (type == 1) {
    return 'img_' + Date.parse(date) + '_' + rand()
  } else {
    return 'doc_' + Date.parse(date) + '_' + rand()
  }
}

// Validamos el tipo de Archivo  1: todos los archivos; 2: Solo fotografias;
function file_type(ext, categories, name) {
  var ext_img = new Array('.JPG', '.jpg', '.jpeg', '.gif', '.PNG', '.png')
  var ext_arg = new Array(
    '.zip',
    '.rar',
    '.ppt',
    '.pptx',
    '.ppsx',
    '.pps',
    '.doc',
    '.docx',
    '.accdb',
    '.ccdb',
    '.mdb',
    '.xlsx',
    '.xls',
    '.xlsm',
    '.xlsb',
    '.pdf',
    '.PDF',
  )
  if (jQuery.inArray(ext, ext_img) >= 0) {
    return 1
  } else if (jQuery.inArray(ext, ext_arg) >= 0 && categories == 1) {
    return 2
  } else {
    notify(
      null,
      'No permitido',
      'El archivo "' + name + '" no esta dentro de los formatos permitidos.',
      1,
    )
    return 0
  }
}

/**
 *
 * @param {string} ext Extencion del Archivo
 */
function TypeFile(ext) {
  var ext_img = new Array('.JPG', '.jpg', '.jpeg', '.gif', '.PNG', '.png')
  var ext_arg = new Array(
    '.zip',
    '.rar',
    '.ppt',
    '.pptx',
    '.ppsx',
    '.pps',
    '.doc',
    '.docx',
    '.accdb',
    '.ccdb',
    '.mdb',
    '.xlsx',
    '.xls',
    '.xlsm',
    '.xlsb',
    '.pdf',
    '.PDF',
  )

  if (jQuery.inArray(ext, ext_img) >= 0) {
    return 1
  } else if (jQuery.inArray(ext, ext_arg) >= 0) {
    return 2
  } else {
    return 0
  }
}

/**
 *
 * @param {int} size Tamaño File
 * @param {int} size_default Tamaño maximo
 * @param {strin} name Nombre del Archivo
 */
function file_size(size, size_default, name) {
  var size_max = 1000000 * size_default
  if (size <= size_max) {
    return 1
  } else {
    notify(
      null,
      'Supero el Tamaño',
      'El archivo "' + name + '" excedió el peso permitido.',
      1,
    )
    return 0
  }
}

/**
 *
 * @param {class} cont Objeto de la clase updloadS3
 * @param {array} data Array con informacion de elemento a crear
 * @param {int} type 1: Img; 2: Documneto, 3: Img Cargado; 4: Documento Cargado;
 * @param {string} name_ramdom Nombre del archivo que esta en el repositorio.
 */
function add_file(cont, data, type, name_ramdom) {
  var name_fom = '#' + data.form_d
  cont.listFiles.append(
    '<li id="' +
      data.form_d +
      '" data-id="0" data-state="0" data-name="' +
      name_ramdom +
      '" class="div_list item"></li>',
  )
  cont.template.clone().prependTo(name_fom).show()

  var form = $('#' + data.form_d)

  form.find('.error').hide()
  form.find('.download').hide()

  form.children().attr('id', 'template')

  // Información
  form.attr('data-id', data.cont)
  form.find('.name').text(data.name)
  form.find('.name').attr('title', data.name)
  form.find('.delete').attr('data-id', data.cont)

  if (type == 1) {
    var reader = new FileReader()
    reader.onload = function (e) {
      $(name_fom + ' .image').css(
        'background-image',
        'url(' + e.target.result + ')',
      )
      $(name_fom + ' .image').css('background-size', '100%')
    }
    reader.readAsDataURL(data.file)
  } else if (type == 2) {
    form
      .find('.download')
      .attr('onclick', "getFileS3('" + name_ramdom + "', 2)")
    $(name_fom + ' .image').css(
      'background-image',
      'url(' + cont.files_url + 'app/ico/' + file_ico[data.ext] + ')',
    )
  } else if (type == 3) {
    form
      .find('.image')
      .css(
        'background-image',
        'url(' + cont.files_url + 'thumbnails/' + data.name_tmp + ')',
      )
    form.find('.image').css('background-size', '100%')
    form.find('.cont').hide()
  } else if (type == 4) {
    form.find('.download').show()
    form
      .find('.download')
      .attr('onclick', "getFileS3('" + data.name_tmp + "', 2)")
    form
      .find('.image')
      .css(
        'background-image',
        'url(' + cont.files_url + 'app/ico/' + file_ico[data.ext] + ')',
      )
    form.find('.cont').find('.prog').hide()
    form.find('.cont').find('.text').addClass('name_file')
  }

  if (type == 4 || type == 3) {
    form.find('.delete').click(function (e) {
      e.preventDefault()

      let id = form.data('id')
      let name = form.data('name')
      form.remove()

      cont.data.forEach(function (elemento, indice, array) {
        elemento.id == id ? cont.data.splice(indice, 1) : null
      })

      cont.dataDelete.push(id)
      cont.validateRemove(true)
    })
  }
}
