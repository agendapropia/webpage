const modalChangePasswordUser = $('#modal-change-of-password')
const formChangePasswordUser = $('#form-change-password-user')
const messageErrorUserPass = modalChangePasswordUser.find(
  '.error-change-password',
)

$('.button-modal-change-of-password').click(function (e) {
  modalChangePasswordUser.modal('show')
  messageErrorUserPass.hide()
  messageErrorUserPass.text('')
  UtilFormClose(formChangePasswordUser)
  modalChangePasswordUser.find('.overlay').hide()
})

modalChangePasswordUser.find('.button-send-password').click(function () {
  messageErrorUserPass.text('')
  messageErrorUserPass.hide()
  UtilModalLoader(modalChangePasswordUser)
  SendFormUpdateChangePasswordUser.Send()
})

let SendFormUpdateChangePasswordUser = new QueryAjax({
  form: 'form-change-password-user',
  action: 'ActionUpdateChangePasswordUser',
})

function ActionUpdateChangePasswordUser(status, data) {
  if (!status) {
    console.log(status)
  } else if (data.status) {
    modalChangePasswordUser.modal('hide')
    notify(
      false,
      'Usuario Actualizado',
      'La contraseña se actualizo correctamente.',
      2,
    )
    UtilFormClose(formChangePasswordUser)
  } else {
    messageErrorUserPass.html(data.message)
    messageErrorUserPass.show()
  }
  UtilModalLoader(modalChangePasswordUser, false)
}
