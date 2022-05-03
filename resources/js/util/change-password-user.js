var modalChangePasswordUser = $('#modal-change-of-password')
var formChangePasswordUser = $('#form-change-password-user')
var messageErrorUserPass = modalChangePasswordUser.find(
  '.error-change-password',
)

$(document).ready(function () {
  modalChangePasswordUser.find('.button-send-password').click(function () {
    messageErrorUserPass.text('')
    messageErrorUserPass.hide()
    UtilModalLoader(modalChangePasswordUser)
    SendFormUpdateChangePasswordUser.Send()
  })
  $('.button-modal-change-of-password').click(function (e) {
    e.preventDefault()
    modalChangePasswordUser.modal('show')
    messageErrorUserPass.text('')
    messageErrorUserPass.hide()
    UtilFormClose(formChangePasswordUser)
  })
})

let SendFormUpdateChangePasswordUser = new QueryAjax({
  form: 'form-change-password-user',
  action: 'ActionUpdateChangePasswordUser',
})

function ActionUpdateChangePasswordUser(status, data) {
  if (!status) {
    console.log(status)
  } else if (data.status) {
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
