var tokenCsrf = $('meta[name=csrf-token]').attr('content')

class searchByAutocomplete {
  constructor(container, settings) {
    this.container = container

    this.xhr = null
    this.method = 'GET'
    this.url = ''
    this.parameters = []
    this.params = []

    this.actionBefore = null
    this.actionAfter = null

    this.input = null
    this.ulItems = null
    this.divSelectedItems = null
    this.inputHidden = null
    this.labelError = null
    this.animationClass = 'fa-spin'
    this.iconSearch = 'fa-search'
    this.iconLoading = 'fa-cog'
    this.paramSearch = 'search'

    this.data = []
    this.selectedItems = []
    this.limitItems = 1

    let context = this
    $.each(settings, function (key, value) {
      context[key] = value
    })

    this.loadElementHtml()
    this.loadParameters()
    this.addParameter(this.paramSearch)
    this.resetItems(false)
    this.requestGetUrl()
    this.eventKeyupSearchField()
    this.evetOutsideContainer()
  }
  eventAddDataSelected(data) {
    let obj = data instanceof Object
    if (!obj) {
      this.printLog('Not Object')
      return false
    }

    let id = data.id
    let name = data.name
    let image = data.image
    this.addItemSelected(id, name, image)
  }
  evetOutsideContainer() {
    this.containerId = this.container.attr('id')
    let context = this
    window.addEventListener('click', function (e) {
      if (!document.getElementById(context.containerId).contains(e.target)) {
        context.resetItems(false)
      }
    })
  }
  loadElementHtml() {
    this.input = this.container.find('.input-search')
    if (!this.input.length) {
      this.printLog('Input search not found')
    }

    this.inputHidden = this.container.find('.input-hidden')
    if (!this.inputHidden.length) {
      this.printLog('Input hidden not found')
    }

    this.ulItems = this.container.find('.items')
    if (!this.ulItems.length) {
      this.printLog('ul-items not found')
    }

    this.iconInput = this.container.find('.icon-loading')
    if (!this.iconInput.length) {
      this.printLog('iconInput not found')
    }

    this.labelError = this.container.find('.label-error')
    if (!this.labelError.length) {
      this.printLog('labelError not found')
    }
    this.divSelectedItems = this.container.find('.selected-items')
    if (!this.divSelectedItems.length) {
      this.printLog('divSelectedItems not found')
    }
  }
  eventKeyupSearchField() {
    let context = this
    this.input.keyup(function () {
      if (context.getParameter(context.paramSearch) == $(this).val()) {
        return true
      }
      context.setParameter(context.paramSearch, $(this).val())
      context.requestByEventKeyupSearch($(this).val())
    })
  }
  setMessageSearch(status, messageType = 1) {
    let messages = [
      '<em class="fa fa-exclamation-circle"> Ocurrio un error',
      '<em class="fa fa-exclamation-circle"> Mínimo tres caracteres para iniciar la busqueda',
      '<em class="fa fa-exclamation-circle"> No se encontraron resultados',
    ]
    let classMessages = ['', 'label-error-search', 'label-error-result']
    if (status) {
      this.labelError.addClass(classMessages[messageType])
      this.labelError.html(messages[messageType])
    } else {
      classMessages.forEach(function (value) {
        this.labelError.removeClass(value)
      }, this)
      this.labelError.text('')
    }
  }
  eventLoading(status) {
    if (status) {
      this.iconInput.addClass(this.animationClass)
      this.iconInput.addClass(this.iconLoading)
      this.iconInput.removeClass(this.iconSearch)
    } else {
      this.iconInput.removeClass(this.animationClass)
      this.iconInput.removeClass(this.iconLoading)
      this.iconInput.addClass(this.iconSearch)
    }
  }
  requestByEventKeyupSearch(text) {
    let context = this
    clearInterval(this.interval)
    this.setMessageSearch(false)
    this.eventLoading(true)

    this.interval = setInterval(
      function () {
        clearInterval(context.interval)
        if (text.length >= 3) {
          context.request()
        } else if (!text.length) {
          context.resetItems(false)
          context.setMessageSearch(false)
          context.eventLoading(false)
        } else {
          context.resetItems(false)
          context.setMessageSearch(true)
          context.eventLoading(false)
        }
      },
      700,
      'JavaScript',
    )
  }
  loadParameters() {
    this.params.forEach(function (value) {
      if (typeof value === 'object') {
        this.addParameter(value.name, value.value)
      }
    }, this)
  }
  addParameter(name, value) {
    this.parameters.push({ name: name, value: value })
  }
  setParameter(paramName, paramValue) {
    this.parameters.forEach(function (value, key) {
      if (value.name == paramName) {
        this.parameters[key].value = paramValue
        return true
      }
    }, this)
  }
  getParameter(paramName) {
    let result = null
    this.parameters.forEach(function (value, key) {
      if (value.name == paramName) {
        result = this.parameters[key].value
      }
    }, this)

    return result
  }
  requestGetUrl() {
    let url = this.url

    if (this.method == 'GET') {
      let separator = '?_'
      $.each(this.parameters, function (key, value) {
        url += `${separator}${value.name}=${value.value}`
        separator = '&_'
      })
    }
    return url
  }
  requestGetData() {
    if (this.method == 'GET') {
      return []
    }
  }
  requestStateXhr() {
    if (this.xhr && this.xhr.readyState != 4) {
      this.xhr.abort()
    }
  }
  request() {
    this.requestStateXhr()
    this.requestGetUrl()

    let context = this
    this.xhr = $.ajax({
      url: context.requestGetUrl(),
      data: context.requestGetData(),
      dataType: 'json',
      type: context.method,
    })
      .done(function (data) {
        context.eventLoading(false)
        context.requestSuccessfull(data)
      })
      .fail(function (errors) {
        context.eventLoading(false)
        context.requestFailed(errors)
      })
  }
  requestSuccessfull(data) {
    this.data = data.data
    this.resetItems(true)

    if (!this.data.length) {
      this.setMessageSearch(true, 2)
      this.resetItems(false, false)
      return true
    }

    this.data.forEach(function (value, key) {
      this.ulItems.append(`<li data-id="${key}">
        ${value.name}
      </li>`)
    }, this)

    this.eventSelectItem()
  }
  eventSelectItem() {
    let context = this
    this.setMessageSearch(false)
    this.ulItems.find('li').click(function () {
      let elem = context.data[$(this).attr('data-id')]
      let id = elem.id
      let name = elem.name
      let image = elem.image
      context.addItemSelected(id, name, image)
    })
  }
  addItemSelected(id = '', name = '', image = '') {
    this.selectedItems.push({
      id: id,
      name: name,
      image: image,
    })
    this.eventLimitItems()
    this.resetItems(false, true)
    this.listItems()
    this.setInputHidden()
  }
  setInputHidden() {
    this.inputHidden.val(this.getParameterToInput())
  }
  getParameterToInput() {
    let data = ''
    let separator = ''
    $.each(this.selectedItems, function (key, value) {
      data += `${separator}${value.id}`
      separator = ','
    })
    return data
  }
  eventRemoveItem() {
    let context = this
    this.divSelectedItems.find('label em').click(function () {
      context.selectedItems.splice($(this).attr('data-id'), 1)
      context.listItems()
      context.eventLimitItems()
      context.setInputHidden()
    })
  }
  eventLimitItems() {
    if (this.selectedItems.length >= this.limitItems) {
      this.input.prop('disabled', true)
      this.iconInput.addClass('icon-disabled')
      if (this.limitItems == 1) {
        this.input.addClass('item-limit-display')
        this.iconInput.addClass('item-limit-display')
        this.divSelectedItems.addClass('display-unique')
      }
    } else {
      this.input.prop('disabled', false)
      this.iconInput.removeClass('icon-disabled')
      if (this.limitItems == 1) {
        this.input.removeClass('item-limit-display')
        this.iconInput.removeClass('item-limit-display')
        this.divSelectedItems.removeClass('display-unique')
      }
    }
  }
  listItems() {
    this.divSelectedItems.html('')
    this.selectedItems.forEach(function (value, key) {
      this.divSelectedItems.append(`<label class="badge badge-light">
        ${value.name}
        <em class="fa fa-close" data-id="${key}">
      </label>`)
    }, this)
    this.eventRemoveItem()
  }
  requestFailed(errors) {
    this.resetItems(false)
    this.printLog('request failed')
  }
  resetItems(status, clearField = false) {
    this.ulItems.html('')
    if (status) {
      this.ulItems.css('display', 'block')
    } else {
      this.ulItems.css('display', 'none')
    }

    if (clearField) {
      this.input.val('')
      this.inputHidden.val('')
    }
  }
  clearSelect() {
    this.selectedItems = []
    this.eventLimitItems()
    this.resetItems(false, true)
    this.listItems()
  }
  printLog(message) {
    console.log(`ERROR_SEARCH_BY_AUTOCOMPLETE: ${message}`)
  }
}
