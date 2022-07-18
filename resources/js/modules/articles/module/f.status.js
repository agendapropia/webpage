const modalStatus = $('#modal-status-main')
const formStatus = $('form[name=form-status-main]')
const selectStatus = formStatus.find('select[name=status_id]')

function ActionModalStatus(data) {
  UtilClearFormUi(formStatus)
  formStatus.find('input[name=id]').val(data.id)
  selectStatus.val(data.status_id)
}

function ActionQueryStatusSend() {
  ActionQueryStatus.Send()
  modalStatus.find('.overlay').show()
}

let ActionQueryStatus = new QueryAjax({
  form: 'form-status-main',
  action: 'ActionQueryStatusFinish',
})
function ActionQueryStatusFinish(status, data) {
  if (status && data.status) {
    notify(false, 'Estado actualizado', 'Operación realizada exitosamente', 2)
    modalStatus.modal('hide')
    TableMain.refresh(false)
  } else if (!data.status) {
    notify(false, data.message, '', 1)
  }
  modalStatus.find('.overlay').hide()
  ActionQueryStatus.FormClose()
}
