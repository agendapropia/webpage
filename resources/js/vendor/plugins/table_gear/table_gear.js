/** Variable GLOBAL {token_csrf}*/
var token_csrf = $('meta[name=csrf-token]').attr('content')

class tableGear {
  /**
   *
   * @param {element} content Contiene todo el block donde se va a ejecutal la clase
   * @param {string} url Es la direccion donde se va a realizar la peticion
   * @param {array} table Permite definir la estructura de la tabla por medio de un array {" ", "Nombre", "Apellido"}
   * @param {string} functionOptional Permite ejecutar dicha funcion luego de traer los datos del AJAX
   *
   * @param {class} noneColumn "none-column" en los tds del template permiten ocultarlos.
   *
   * @version 1.0
   */

  constructor(content, url, table, functionOptional = false) {
    this.content = content
    this.template = this.content.find('.template-list').html()
    this.loader = this.content.find('.overlay')

    this.table = table
    this.data = ''
    this.dataSelect = ''
    this.modalSelect = ''
    this.data_complete = ''

    this.method = 'GET'
    this.xhr = ''
    this.lastCheckedListData = null
    this.checks = ''
    this.name_url = ''
    this.meta_field_text = {
      key: '',
      field: '',
      value: '',
    }

    this.iconLeft = 'fa fa-arrow-left'
    this.iconRigth = 'fa fa-arrow-right'
    this.numberPage = `<button type="button" class="btn ">
			                  <i class="wb-refresh" aria-hidden="true"></i>
			                </button>`

    this.form = {
      url: url,
      data: '',
      pag: 1,
    }
    this.filter = {
      search: '',
      row: 10,
      token: token_csrf,
    }
    this.functionOptional = functionOptional
    this.hiddenColumn = true
    this.hiddenColumnAlt = true
    this.tablePaginate = true
    this.tableFilterRow = this.content.find('.filter_row')
    this.keepUrl = false

    this.checkFunctionEnabler = false
    this.checkFunction = ''

    let cont = this
    this.content.find('.filter_refresh').click(function () {
      cont.refresh()
    })
    this.content.find('.filter_select_1').click(function () {
      cont.CheckboxSelect(true)
    })
    this.content.find('.filter_select_0').click(function () {
      cont.CheckboxSelect(false)
    })
    this.content.find('.menu-select').hide()
  }
  // actualiza la url aplicando los filtros en una variable tipo GET
  AddUrlTable() {
    if (!this.keepUrl) {
      var sim = '?'
      var url = this.name_url
      $.each(this.filter, function (key, value) {
        if (value && key != 'token') {
          url += sim + key + '=' + value
          sim = '&'
        }
      })
      history.pushState(
        {
          selector: '',
        },
        '/' + this.name_url,
        url,
      )
    }
  }
  // toma las variables GET de la url y actualiza los filtros
  RefreshUrl() {
    let cont = this

    if (!this.keepUrl) {
      $.each(cont.filter, function (key, value) {
        if ($.get(key)) {
          cont.filter[key] = $.get(key)
          let valueFilter = cont.filter[key]
          $(cont.content)
            .find('.filter_' + key + ' option[value="' + $.get(key) + '"]')
            .prop('selected', true)
          $(cont.content)
            .find('.filter_' + key + '')
            .val($.get(key))

          if ($('.filter_' + key).prop('type') == 'button') {
            var options = $('.filter_' + key)
              .siblings()
              .find('a')
            let text = null
            $.each(options, function (key, value) {
              if ($(value).attr('value') == valueFilter) {
                text = $(value).html()
              }
            })
            $(cont.content)
              .find('.filter_' + key + '')
              .html(text)
          }
        }
      })
    }
  }
  // verifica la variable y almacena la nueva peticion AJAX
  StateXhr() {
    if (this.xhr && this.xhr.readyState != 4) {
      this.xhr.abort()
    }
  }
  // permite seleccional las tabla donde se van a incluir los datos
  SelectList() {
    return $(this.content).find('table')
  }
  // limpia la tabla invocando a .list_table
  PrintList(data) {
    $(this.SelectList()).html(data)
  }
  // anade contenido a la tabla invocando a .list_table
  AppendList(data) {
    $(this.SelectList()).append(data)
  }
  isDataURL() {
    return this.method == 'GET' ? true : false
  }
  // actualiza la variable data_send que va ser enviada en la petiion AJAX
  refreshForm() {
    let form = this.filter
    let data_send = '',
      separ = ''

    $.each(form, function (key, value) {
      data_send += separ + '_' + key + '=' + value
      separ = '&'
    })
    this.form.data = data_send
  }
  // realiza la peticion AJAX al servidor
  list() {
    let cont = this
    this.StateXhr()
    this.refreshForm()

    let url_finish = this.form.url + '?page=' + this.form.pag

    this.xhr = $.ajax({
      url: cont.isDataURL() ? url_finish + '&' + this.form.data : url_finish,
      data: cont.isDataURL() ? null : this.form.data,
      dataType: 'json',
      type: cont.method,
    })
      .done(function (result) {
        cont.ResultData(result)
      })
      .fail(function (errors) {
        cont.ResultError(errors)
      })
  }
  // ejecuta la infomracion que llego luego de la peticion AJAX
  ResultData(result) {
    let cont = this
    this.data = result.data.data
    this.data_complete = result

    // lista la informacion de la tabla
    this.LoadListTable()

    // oculta el paginate de la tabla
    this.tablePaginate ? this.paginate(6) : this.tableFilterRow.hide()

    // ajusta el tamano de la primera columna
    this.AutoWidthTd()

    this.CheckboxAddClass()
    this.CheckboxShiftAdd()

    // oculta el cargador
    this.loader.hide()

    // ejecuta la funcion opcional
    this.functionOptional ? self[cont.functionOptional](result) : false

    // detemos loading
    this.ChangeFieldIcon(false)

    if (!result.data.data.length) {
      this.DivItemsNotFound(true)
    }
  }
  // mostrar el div de no hay registros
  DivItemsNotFound(status = false) {
    let display = status ? 'block' : 'none'
    $(this.content).find('.items-not-found').css('display', display)
  }
  // crea las funciones para los filtros
  FilterFunction() {
    let cont = this

    $.each(this.filter, function (key, value) {
      let campo = key

      if ($('.filter_' + key).length) {
        if ($('.filter_' + key).prop('type') == 'select-one') {
          cont.content.find('.filter_' + key).change(function () {
            cont.FilterRefresh(campo, $(this).val())
          })
        } else if ($('.filter_' + key).prop('type') == 'text') {
          let status_update = false

          cont.content.find('.filter_' + key).keyup(function () {
            cont.meta_field_text.field = '.filter_' + key
            cont.meta_field_text.key = key
            cont.meta_field_text.value = $(this).val()

            cont.IntervalClear()
            cont.IntervalField()
            cont.ChangeFieldIcon(true)
            cont.ChangeFieldMessage(false)
          })
        } else if ($('.filter_' + key).prop('type') == 'button') {
          let obj = cont.content.find('.filter_' + key)
          obj
            .siblings()
            .find('a')
            .click(function () {
              obj.html($(this).html())
              obj.val($(this).attr('value'))
              cont.FilterRefresh(campo, obj.val())
            })
        }
      }
    })
  }
  ChangeFieldMessage(status = true) {
    let label = this.content.find(
      '.filter_' + this.meta_field_text.key + '_label',
    )
    let value = this.meta_field_text.value
    if (!status) {
      label.hide()
    } else if (value.length <= 2 && value.length > 0) {
      label.show()
    } else {
      label.hide()
    }
  }
  ChangeFieldIcon(status = true) {
    let class_spin = 'fa-spin'
    let class_icon_search = 'fa-search'
    let class_icon_loading = 'fa-cog'
    let i = this.content.find('.filter_' + this.meta_field_text.key + '_icon')

    if (status) {
      i.addClass(class_spin)
      i.addClass(class_icon_loading)
      i.removeClass(class_icon_search)
    } else {
      i.removeClass(class_spin)
      i.removeClass(class_icon_loading)
      i.addClass(class_icon_search)
    }
  }
  //Detiene el intervalo para realizar la consulta de los input text
  IntervalClear() {
    clearInterval(this.interval)
  }
  //Inicia el intervalo para consulta input text
  IntervalField() {
    let cont = this
    this.interval = setInterval(
      function () {
        cont.QueryField()
      },
      700,
      'JavaScript',
    )
  }
  //Aplica la consulta input text
  QueryField() {
    this.IntervalClear()
    this.ChangeFieldMessage()
    if (this.meta_field_text.value.length >= 3) {
      this.FilterRefresh(this.meta_field_text.key, this.meta_field_text.value)
    } else {
      if (this.filter[this.meta_field_text.key] != '') {
        this.FilterRefresh(this.meta_field_text.key, '')
      } else {
        // detemos loading
        this.ChangeFieldIcon(false)
      }
    }
  }
  FilterRefresh(camp, value) {
    this.filter[camp] = value
    this.form.pag = 1
    this.refresh()
  }
  // ejecuta los errores de la peticion AJAX
  ResultError(result) {
    this.loader.hide()
    this.FailQuery(result)
  }
  // listDataTable
  LoadListTable() {
    let cont = this
    let data = this.data_complete.data.data
    let tmp = $(this.template)

    this.data = []
    this.PrintList('')
    this.content.find('.JCLRgrips').remove()

    // muestra el trbody de la tabla
    let itemTitleTable = tmp.clone()
    this.LoadDataTable(
      itemTitleTable,
      this.table,
      null,
      1,
      this.hiddenColumn,
      this.hiddenColumnAlt,
    )
    this.AppendList(itemTitleTable)

    $.each(data, function (key, value) {
      // clona he anade la fila de la table
      let item = tmp.clone()
      cont.LoadDataTable(
        item,
        value,
        key,
        2,
        cont.hiddenColumn,
        cont.hiddenColumnAlt,
      )
      cont.AppendList(item)

      // guarda la informacion en la variable this.data
      cont.data[key] = new structureData(key, value)
    })
  }
  // carga los datos en el td
  LoadDataTable(item, data, key, type, hidden, hidden_alt) {
    // tipo 1 carga la informacion del encabezado de la tabla
    if (type == 1) {
      let tds = item[0].cells
      $.each(tds, function (i, element) {
        $(element).html(data[i])
        $(element).addClass('orderColumn')
      })
    }
    // tipo 2 carga la informacion de filas de la tabla
    else if (type == 2) {
      //informacion del tr
      item.attr('data-id', data.id)
      item[0].innerHTML = item[0].innerHTML.replace('#key#', 'id_chk' + key)

      // valida si la consulta trae el campo "state_tr" para cambiar el estado del tr
      if (data.state_tr == 0 || data.state_tr == false) {
        $(item).addClass('state_' + data.state_tr)
      }

      //carga los tds
      $.each(data, function (i, data) {
        item[0].innerHTML = item[0].innerHTML.replaceAll('#_' + i + '_#', data)
      })

      /** Format Number */
      let numberTr = $(item[0]).find('.number')
      $.each(numberTr, function (key, value) {
        let currency = $(value).attr('data-currency')
        let currency_right = $(value).attr('data-currency-right')
        let decimals = $(value).attr('data-decimals')
        let numberFormated = ''
        if ($(value).html() != 'null') {
          numberFormated = formatNumber.new($(value).html(), currency, decimals)
        } else {
          numberFormated = formatNumber.new(0, currency, decimals)
        }
        currency_right
          ? $(value).text(numberFormated + ' ' + currency_right)
          : $(value).text(numberFormated)
      })

      /** Format booblean */
      let booleanTr = $(item[0]).find('.boolean')
      $.each(booleanTr, function (key, value) {
        let trueString = $(value).attr('data-true')
        let falseString = $(value).attr('data-false')
        let booleanString = ''
        if ($(value).html() == 1) {
          booleanString = trueString
        } else {
          booleanString = falseString
        }
        $(value).text(booleanString)
      })
    }

    // si hay campos para ocultar lo hace
    hidden_alt
      ? (item[0].innerHTML = item[0].innerHTML.replaceAll(
          'none-alt-column',
          'hide-column',
        ))
      : null
    hidden
      ? (item[0].innerHTML = item[0].innerHTML.replaceAll(
          'none-column',
          'hide-column',
        ))
      : null
  }

  // paginations la tabla
  paginate(num) {
    //Selecciona el div donde se pintaran los botones de paginacion.
    let divPaginate = $(this.content).find('.paginate')
    divPaginate.html('')

    this.PaginateBtn(num)
    var cont = this

    //funcion que se encarga de imprimir los botones.
    divPaginate.find(':button').click(function () {
      let type = $(this).data('state')
      let page = $(this).data('page')
      let pag = cont.data_complete.data.current_page

      if (type == 0) {
        pag--
      } else if (type == 1) {
        pag++
      } else if (type == 2) {
        pag = page
      }

      cont.form.pag = pag
      cont.refresh()
    })
  }
  // paginations crea el los botones
  PaginateBtn(numRows) {
    let cont = this
    let divPaginate = $(this.content).find('.paginate')
    let data = this.data_complete.data

    let num_p = data.last_page //4
    let num_page = data.current_page
    let for_i = 1

    if (numRows >= num_p) {
      numRows = num_p - 1
    } else {
      if (num_page - numRows / 2 >= 1) {
        if (num_page + numRows / 2 <= num_p) {
          for_i = num_page - numRows / 2
        } else {
          for_i = num_p - numRows
        }
      }
    }

    cont.PaginatePrintBnt(
      divPaginate,
      0,
      data.current_page - 1,
      'Anterior',
      1,
      this.iconLeft,
      data,
    )
    for (var i = for_i; i <= for_i + numRows; i++) {
      cont.PaginatePrintBnt(divPaginate, 2, i, 'Pagina ' + i, 0, i, data)
    }
    cont.PaginatePrintBnt(
      divPaginate,
      1,
      data.current_page + 1,
      'Siguiente',
      1,
      this.iconRigth,
      data,
    )

    let tot = $(this.content).find('.paginate-total')
    tot.text('Total: ' + data.total)

    divPaginate.click(function () {
      $('html,body').animate(
        {
          scrollTop: $(cont.content).offset().top - 140,
        },
        250,
      )
    })
  }
  // paginations print btn
  PaginatePrintBnt(div, state, page, title, type, value, data) {
    let temp = this.numberPage
    let btn = $(temp).clone()

    btn.attr('data-state', state)
    btn.attr('data-page', page)
    btn.attr('title', title)

    if (type == 1) {
      btn.find('i').addClass(value)
    } else {
      btn.text(value)
    }

    state == 0 ? btn.addClass('btn-previous') : ''
    state == 1 ? btn.addClass('btn-next') : ''

    if (state == 0) data.current_page == 1 ? btn.attr('disabled', true) : ''

    if (state == 1)
      data.current_page == data.last_page ? btn.attr('disabled', true) : ''

    if (state == 2) data.current_page == page ? btn.addClass('btn-primary') : ''

    $(div).append(btn)
  }

  /**
   * @description show errors in notifications
   * @param {Array} errors
   */
  FailQuery(errors) {
    errors.status == 500 ? notify(3) : null
    errors.status == 404 ? notify(1) : null
    errors.status == 422 ? notify(4) : null
  }

  /**
   * @description Apply css to checkboox
   */
  CheckboxAddClass() {
    $(this.content).find('.checkbox-icheck').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_minimal',
      increaseArea: '20%',
    })
  }

  /**
   * @description Function Select all (true/false)
   */
  CheckboxSelect(state, type = false, element = false) {
    let content = $(this.SelectList())
    let checkGroup = element ? element : content.find('input:checkbox')
    let c_everyboby = content.find('.check_everyboby')
    let default_tr = checkGroup.parent().parent().parent()

    state ? checkGroup.iCheck('check') : checkGroup.iCheck('uncheck')
    state ? default_tr.addClass('active') : default_tr.removeClass('active')
    state
      ? c_everyboby.prop('checked', true)
      : c_everyboby.prop('checked', false)

    this.CheckboxCount()
  }

  /**
   * @description Function Select all (true/false)
   */
  CheckboxArraySelect(key, value) {
    let cont = this
    $.each(this.data_complete.data.data, function (elemt, data) {
      if (data[key] == value) {
        cont.CheckboxSelect(true, true, cont.content.find('#id_chk' + elemt))
      }
    })
  }

  /**
   * @description saves the checks of the list in this.data
   */
  CheckboxCount() {
    let checkGroup = this.SelectList().find('input:checkbox')
    this.checks = []
    this.checks.length = 0

    let class_tr = this
    let cont = 0
    for (let x = 0; x < checkGroup.length; x++) {
      if (checkGroup[x].checked) {
        class_tr.checks[cont] = $(checkGroup[x])
          .parent()
          .parent()
          .parent()
          .data('id')
        cont = cont + 1
      }
    }

    cont
      ? this.content.find('.menu-select').show()
      : this.content.find('.menu-select').hide()
    this.content.find('.menu-select').find('.number-selected').text(cont)

    this.checkFunctionEnabler ? self[this.checkFunction](class_tr.checks) : null
  }

  /**
   * @description Select one and select shiftkey of the list (Check)
   */
  CheckboxShiftAdd() {
    let div = this.SelectList()
    let chkboxes = div.find('.iCheck-helper')
    let class_tr = this

    $(chkboxes).click(function (e) {
      let checkGroup = div.find('input:checkbox')
      let check = $(this).siblings('input:checkbox')
      let tr_default = check.parent().parent().parent()

      check.is(':checked')
        ? tr_default.addClass('active')
        : tr_default.removeClass('active')

      if (!class_tr.lastCheckedListData) {
        class_tr.lastCheckedListData = check
        class_tr.CheckboxCount()
        return
      }

      if (e.shiftKey) {
        let start = checkGroup.index(check)
        let end = checkGroup.index(class_tr.lastCheckedListData)

        let sliceCheck = checkGroup.slice(
          Math.min(start, end),
          Math.max(start, end) + 1,
        )

        for (let i = sliceCheck.length - 1; i >= 0; i--) {
          let default_check = $(
            checkGroup.slice(Math.min(start, end), Math.max(start, end) + 1)[i],
          )
          let default_tr = default_check.parent().parent().parent()

          check.is(':checked')
            ? default_tr.addClass('active')
            : default_tr.removeClass('active')
          check.is(':checked')
            ? default_check.iCheck('check')
            : default_check.iCheck('uncheck')
        }
      }

      class_tr.lastCheckedListData = check
      class_tr.CheckboxCount()
    })
  }
  /**
   * @description Function Select all (true/false)
   */
  ChangeRow(element) {
    let rows = $(element).html()
    this.filter.row = rows
    this.form.pag = 1
    this.refresh()
  }
  /**
   * @description Execute Action from the buttons
   */
  Modal(element) {
    let tr = $(element).parent().parent().index()
    let action = $(element).data('action')

    this.modalSelect = $($(element).data('modal'))

    this.dataSelect = tr ? this.data[tr - 1].data : 0

    this.modalSelect.modal('show')
    this.ModalLoader(false)

    action ? self[action](this.dataSelect) : false

    let cont = this
    this.modalSelect.find('.btn-close').click(function () {
      cont.ModalClose()
    })
  }
  /**
   * @param {boolean} status
   * @returns change modal loader status
   */
  ModalLoader(status) {
    if (this.modalSelect) {
      if (status) {
        this.modalSelect.find('.overlay').show()
      } else {
        this.modalSelect.find('.overlay').hide()
      }
    }
  }
  /**
   * @description Basic functions of modal closure
   * @param {form} form modals list
   */
  ModalClose(form = null) {
    form ? form[0].reset() : null
    this.ModalLoader(false)

    if (this.modalSelect) {
      this.modalSelect.modal('hide')
    }

    form ? this.ModalClearForm(form) : null
  }
  ModalClearForm(form) {
    let input = form.find('input')
    let select = form.find('select')
    let textarea = form.find('textarea')
    input.removeClass('is-invalid')
    select.removeClass('is-invalid')
    textarea.removeClass('is-invalid')
    input.parent().find('.label-error').html('')
    select.parent().find('.label-error').html('')
    textarea.parent().find('.label-error').html('')
  }
  ModalValidateInputs(errors, form) {
    this.ModalClearForm(form)

    $.each(errors, function (key, value) {
      let input = form.find('input[name=' + key + ']')
      let select = form.find('select[name=' + key + ']')
      let textarea = form.find('textarea[name=' + key + ']')

      input
        .parent()
        .find('.label-error')
        .html('<i class="fa fa-exclamation-triangle"></i> ' + value)

      if (input.hasClass('flatpickr-input')) {
        input
          .parent()
          .parent()
          .find('.label-error')
          .html('<i class="fa fa-exclamation-triangle"></i> ' + value)
      }

      select
        .parent()
        .find('.label-error')
        .html('<i class="fa fa-exclamation-triangle"></i> ' + value)

      textarea
        .parent()
        .find('.label-error')
        .html('<i class="fa fa-exclamation-triangle"></i> ' + value)

      input.addClass('is-invalid')
      select.addClass('is-invalid')
      textarea.addClass('is-invalid')
    })
  }
  ModalLoadForm() {
    let cont = this
    $.each(this.dataSelect, function (key, value) {
      cont.modalSelect
        .find('form')
        .find('input[name=' + key + ']')
        .val(value)
      cont.modalSelect
        .find('form')
        .find('textarea[name=' + key + ']')
        .val(value)
    })
  }

  /**
   *
   * @param {Element} select Example: $('.select')
   * @param {array} data Structure {id: 1, name: Pepe}
   * @param {int|string} selected
   * @param {String} name_default Default name of the first option
   */
  LoadSelect(select, data, selected, name_default) {
    let d = data
    $(select).find('option').remove()
    select.attr('data-placeholder')
      ? (name_default = select.attr('data-placeholder'))
      : null
    if (name_default) {
      $(select).append(
        '<option data-alt="" value="" class="c_gray_cl">' +
          name_default +
          '</option>',
      )
    } else {
      $(select).append(
        '<option data-alt="" value="" class="c_gray_cl">Selecciona...</option>',
      )
    }

    $.each(d, function (key, value) {
      $(select).append(
        $('<option>', {
          value: d[key].id,
          text: d[key].name,
        }),
      )
    })

    selected
      ? select
          .find('option[value="' + selected + '"]')
          .attr('selected', 'selected')
      : ''
  }
  /**
   *
   * @param {Element} radio The html div where is going to be displayed the radio options Example: $('.radio')
   * @param {array} data The array of the objects to be displayed, it must has id and name Structure {id: 1, name: Pepe}
   * @param {int|string} selected The pre defined value of the radio button
   * @param {String} dataField The field of the database related to the input, it must be exactly as in the database
   */
  LoadCheck(check, selected) {
    selected ? check.attr('checked', true) : check.attr('checked', false)
  }
  // ajusta tamano de las columnas 1 de la tabla
  AutoWidthTd() {
    let div = this.SelectList().find('tr')
    var td = $(div[1]).find('td')[0]

    let cont = $(td).find('i').length + $(td).find('input').length
    let camp

    switch (cont) {
      case 1:
        camp = 55
        break
      case 2:
        camp = 40
        break
      case 3:
        camp = 37
        break
      case 4:
        camp = 36
        break
      default:
        camp = 33
        break
    }

    cont ? ($(div[0]).find('td')[0].width = cont * camp + 'px') : null
  }
  // ejecuta la CLASS
  refresh(state = false) {
    this.DivItemsNotFound(false)
    state ? this.FilterFunction() : null
    state ? this.RefreshUrl() : null

    this.AddUrlTable()
    this.refreshForm()
    this.list()
    this.checks = null

    this.content.find('.menu-select').hide()
    this.loader.show()
  }
  GetDataById(idArray) {
    let ansArray = []
    $.each(this.data, function (key, value) {
      if (idArray.find((x) => x === value.data.id)) {
        ansArray.push(value.data)
      }
    })
    return ansArray
  }
}

/**
 *
 * @param {Element} select Example: $('.select')
 * @param {array} data Structure {id: 1, name: Pepe}
 * @param {int|string} selected
 * @param {String} name_default Default name of the first option
 */
function LoadSelect(select, data, selected, name_default) {
  let d = data
  $(select).find('option').remove()

  if (name_default) {
    $(select).append(
      '<option data-alt="" value="" class="c_gray_cl">' +
        name_default +
        '</option>',
    )
  } else {
    $(select).append(
      '<option data-alt="" value="" class="c_gray_cl">Selecciona...</option>',
    )
  }

  $.each(d, function (key, value) {
    $(select).append(
      '<option data-alt="' +
        d[key].alt +
        '" value="' +
        d[key].id +
        '">' +
        d[key].name +
        '</option>',
    )
  })

  selected
    ? $(select)
        .find('option[value="' + selected + '"]')
        .attr('selected', 'selected')
    : ''
}

/**
 * Other Functions
 * @name GET attribute URL
 */
;(function ($) {
  $.get = function (key) {
    key = key.replace(/[\[]/, '\\[')
    key = key.replace(/[\]]/, '\\]')
    var pattern = '[\\?&]' + key + '=([^&#]*)'
    var regex = new RegExp(pattern)
    var url = unescape(window.location.href)
    var results = regex.exec(url)
    if (results === null) {
      return null
    } else {
      return results[1]
    }
  }
})(jQuery)

/**
 * @description Structure data
 */
class structureData {
  constructor(num, data) {
    this.num = num
    this.data = data
  }
}

/**
 *
 * @param {*} type
 * @param {*} title
 * @param {*} text
 * @param {*} numType
 * @param {int|min=1|max=4} position
 */
function notify(type, title = null, text = null, numType = null, position = 2) {
  var msnType = [
    {
      name: 'info',
      icono: 'fa fa-info mr-10',
    },
    {
      name: 'danger',
      icono: 'fa fa-ban mr-10',
    },
    {
      name: 'success',
      icono: 'fa fa-check mr-10',
    },
    {
      name: 'warning',
      icono: 'fa fa-warning mr-10',
    },
  ]

  var notifyDefault = [
    {
      title: 'defaul',
      text: '',
      numType: '1',
    },
    {
      title: 'Comprueba tu Conexión',
      text: 'No se puede conectar a la base de datos',
      numType: '1',
    },
    {
      title: 'La operación se realizo con éxito',
      text: '',
      numType: '2',
    },
    {
      title: 'Error Controller',
      text: 'No se puede recibir información del controlador',
      numType: '1',
    },
    {
      title: 'Problemas al validar los campos',
      text: '',
      numType: '1',
    },
  ]

  if (type) {
    title = notifyDefault[type].title
    text = notifyDefault[type].text
    numType = notifyDefault[type].numType
  }

  positionDev = {
    from: 'bottom',
    align: 'right',
  }
  if (position == 2) {
    positionDev = {
      from: 'bottom',
      align: 'left',
    }
  } else if (position == 3) {
    positionDev = {
      from: 'top',
      align: 'right',
    }
  } else if (position == 4) {
    positionDev = {
      from: 'top',
      align: 'left',
    }
  }

  $.notify(
    {
      icon: msnType[numType].icono,
      title: title,
      message: text,
    },
    {
      element: 'body',
      position: null,
      type: msnType[numType].name,
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: false,
      placement: positionDev,
      offset: 20,
      spacing: 10,
      z_index: 1800,
      delay: 5000,
      timer: 100,
      margin_top: 10,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp',
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: `<div class="alert alert-table-gear dark alert-alt alert-{0} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" data-notify="dismiss" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <span data-notify="icon"></span>
                        {1}<br><a class="alert-link" href="javascript:void(0)">{2}</a>
                    </div>`,
    },
  )
}

/**
 * This function groups an array by a key.
 *
 * @param {array} array The array of the data that is going to be grouped
 * @param {string} key The key value by which the aray is going to be grouped
 *
 * @returns {array} The array grouped by the keys
 */
function GroupBy(array, key) {
  return array.reduce(function (rv, x) {
    ;(rv[x[key]] = rv[x[key]] || []).push(x)
    return rv
  }, {})
}

let location_es = {
  format: 'YYYY-MM-DD',
  separator: ' - ',
  applyLabel: 'Aplicar',
  cancelLabel: 'Cancelar',
  fromLabel: 'From',
  toLabel: 'To',
  customRangeLabel: 'Custom',
  daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
  monthNames: [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre',
  ],
  firstDay: 1,
}

String.prototype.replaceAll = function (search, replacement) {
  var target = this
  return target.split(search).join(replacement)
}

/**
 * Function to format number as currency
 */
function FormatNumber(amount, decimals) {
  amount += ''
  amount = parseFloat(amount.replace(/[^0-9\.]/g, ''))

  decimals = decimals || 0
  if (isNaN(amount) || amount === 0) return parseFloat(0).toFixed(decimals)

  amount = '' + amount.toFixed(decimals)
  var amount_parts = amount.split('.'),
    regexp = /(\d+)(\d{3})/

  while (regexp.test(amount_parts[0]))
    amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2')

  return amount_parts.join('.')
}
/**
 * Function to format number as currency
 */
var formatNumber = {
  separador: '.',
  sepDecimal: ',',
  formatear: function (num) {
    num = parseFloat(num).toFixed(this.decimals)
    num += ''
    var splitStr = num.split('.')
    var splitLeft = splitStr[0]
    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : ''
    var regx = /(\d+)(\d{3})/

    while (regx.test(splitLeft)) {
      splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2')
    }
    return this.simbol + ' ' + (splitLeft + splitRight)
  },
  new: function (num, simbol, decimals) {
    this.simbol = simbol || ''
    this.decimals = decimals || ''
    return this.formatear(num)
  },
}

/** show|hide loader modal */
function loaderContent(modal, s = false) {
  s ? modal.find('.overlay-modal').show() : modal.find('.overlay-modal').hide()
}

/**
 * DATE Select show or hide days
 */
$.datepicker.regional['es'] = {
  closeText: 'Cerrar',
  prevText: '< Ant',
  nextText: 'Sig >',
  currentText: 'Hoy',
  monthNames: [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre',
  ],
  monthNamesShort: [
    'Ene',
    'Feb',
    'Mar',
    'Abr',
    'May',
    'Jun',
    'Jul',
    'Ago',
    'Sep',
    'Oct',
    'Nov',
    'Dic',
  ],
  dayNames: [
    'Domingo',
    'Lunes',
    'Martes',
    'Miércoles',
    'Jueves',
    'Viernes',
    'Sábado',
  ],
  dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
  dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
  weekHeader: 'Sm',
  dateFormat: 'dd/mm/yy',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: '',
}
$.datepicker.setDefaults($.datepicker.regional['es'])

/** QueryAjax */
class QueryAjax {
  constructor(options) {
    this.data = ''
    this.xhr = ''
    this.method = ''
    this.url = ''
    this.action = ''
    this.form = false //form_name
    this.listTable = false

    let cont = this
    $.each(options, function (key, value) {
      cont[key] = value
    })

    this.LoadForm()
    this.var = {
      token: token_csrf,
    }
    this.formatData = {
      token: token_csrf,
    }
  }
  LoadForm() {
    if (this.form) {
      this.form = $('form[name="' + this.form + '"]')
      let action = this.form.attr('action')
      let method = this.form.attr('method')
      action ? (this.url = action) : null
      method ? (this.method = method) : null
    }
  }
  StateXhr() {
    if (this.xhr && this.xhr.readyState != 4) this.xhr.abort()
  }
  IsDataURL() {
    return this.method == 'GET' ? true : false
  }
  // actualiza la variable data_send que va ser enviada en la petiion AJAX
  UpdateForm() {
    if (this.form) {
      this.formatData = this.form.serialize()
    } else {
      let cont = this
      let data_send = '',
        separ = ''
      $.each(this.var, function (key, value) {
        data_send += separ + '_' + key + '=' + value
        separ = '&'
      })
      this.formatData = data_send
    }
  }
  Loader(status = true) {
    this.listTable ? this.listTable.ModalLoader(status) : null
  }
  IsFormListTable() {
    return this.listTable && this.form ? true : false
  }
  Query() {
    let cont = this
    this.Loader()
    this.IsFormListTable() ? this.listTable.ModalClearForm(this.form) : null

    this.StateXhr()
    this.UpdateForm()
    $.ajax({
      url: cont.IsDataURL() ? cont.url + '?' + cont.formatData : cont.url,
      data: cont.IsDataURL() ? null : cont.formatData,
      dataType: 'json',
      type: cont.method,
    })
      .done(function (result) {
        cont.Loader(false)
        cont.ResultSuccess(result)
      })
      .fail(function (errors) {
        cont.Loader(false)
        cont.ResultFailed(errors)
      })
  }
  ResultSuccess(result) {
    this.data = result
    this.action ? self[this.action](true, result) : false
  }
  ResultFailed(errors) {
    this.MapErrors(errors)
    this.data = errors.responseJSON
    this.action ? self[this.action](false, errors) : false
  }
  MapErrors(errors) {
    if (errors.status == 422 && this.IsFormListTable()) {
      this.listTable.ModalValidateInputs(errors.responseJSON.errors, this.form)
    } else {
      let exception_message
      let exception
      if (errors.hasOwnProperty('responseJSON')) {
        exception_message = errors.responseJSON
          ? errors.responseJSON.message
          : 'not found'
        exception = errors.responseJSON
          ? errors.responseJSON.exception
          : 'not found'
        errors.status == 0 ? (exception = 'ERR_INTERNET_DISCONNECTED') : null
      }
      let title =
        'Status: ' +
        errors.status +
        ' Resource: ' +
        this.method +
        ': ' +
        this.url
      let message =
        'Exception: ' + exception + ' <br>Message: ' + exception_message
      notify(false, title, message, 1)
    }
  }
  FormClose(status = true) {
    this.form ? this.form[0].reset() : null
    this.form ? this.listTable.ModalClearForm(this.form) : null
    if (status) {
      this.listTable ? this.listTable.modalSelect.modal('hide') : null
    }
    this.Loader(false)
  }
  Send() {
    this.Query()
  }
}

/**
 * Carga los datos del formulario
 * @param {object} div
 * @param {array} data
 */
function LoadFormInputs(div, data) {
  $.each(data, function (key, value) {
    div
      .find('form')
      .find('input[name=' + key + ']')
      .val(value)
    div
      .find('form')
      .find('textarea[name=' + key + ']')
      .val(value)
  })
}

/**
 * This function loads a "select" through an array
 * 
 * @param {Element} select Example: $('.select')
 * @param {array} data Structure {id: 1, name: Pepe}
 * @param {int|string} selected
 * @param {String} optionDefault Default name of the first option
 */
function LoadSelectUtil(select, data, selected, optionDefault) {
  $(select).find('option').remove()

  if (optionDefault) {
    $(select).append(
      '<option data-alt="" value="" class="c_gray_cl">' +
        optionDefault +
        '</option>',
    )
  } else {
    $(select).append(
      '<option data-alt="" value="" class="c_gray_cl">Selecciona...</option>',
    )
  }

  $.each(data, function (key, value) {
    $(select).append(
      '<option data-alt="' +
        value.alt +
        '" value="' +
        value.id +
        '">' +
        value.name +
        '</option>',
    )
  })

  selected
    ? $(select)
        .find('option[value="' + selected + '"]')
        .attr('selected', 'selected')
    : ''
}

/**
 * this function clear fields of a form
 * 
 * @param {form} form - form to be cleared
 */
function CleanFormUtil(form) {
  let input = form.find('input')
  let select = form.find('select')
  let textarea = form.find('textarea')
  input.removeClass('is-invalid')
  select.removeClass('is-invalid')
  textarea.removeClass('is-invalid')
  input.parent().find('.label-error').html('')
  select.parent().find('.label-error').html('')
  textarea.parent().find('.label-error').html('')
}
