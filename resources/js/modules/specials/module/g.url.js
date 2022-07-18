const modalUrl = $('#modal-url-main')
const formUrl = $('form[name=form-url-main]')
const inputUrl = formUrl.find('input[name=slug]')

function ActionModalUrl(data) {
  UtilClearFormUi(formUrl)
  formUrl.find('input[name=id]').val(data.id)
  inputUrl.val(data.slug)
}

function ActionQueryUrlSend() {
  ActionQueryUrl.Send()
  modalUrl.find('.overlay').show()
}

let ActionQueryUrl = new QueryAjax({
  form: 'form-url-main',
  action: 'ActionQueryUrlFinish',
})
function ActionQueryUrlFinish(status, data) {
  if (status && data.status) {
    notify(false, 'Url actualizada', 'Operación realizada exitosamente', 2)
    modalUrl.modal('hide')
    TableMain.refresh(false)
    ActionQueryUrl.FormClose()
  } else if (!data.status) {
    notify(false, data.message, '', 1)
  }

  modalUrl.find('.overlay').hide()
}

inputUrl.bind('keypress', function (event) {
  var regex = new RegExp('^[a-z-0-9]+$')
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode)
  if (!regex.test(key)) {
    event.preventDefault()
    return false
  }
})
