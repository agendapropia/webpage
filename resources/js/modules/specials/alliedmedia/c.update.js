let modalUpdateMain = $('#modal-update-main')
let formUpdateMain = $('form[name=form-update-main]')

//Funtion Modal Update
function ActionMainUpdate(data) {
  UtilClearFormUi(formUpdateMain)
  queryInitialUpdateMain.var.id = data.id
  formUpdateMain.find('input[name=id]').val(data.id)
  queryInitialUpdateMain.Send()
}

//Get data modal
let queryInitialUpdateMain = new QueryAjax({
  url: '/admin/specials/allied-media/update',
  method: 'GET',
  action: 'UpdateActionModal',
  listTable: TableMain,
})
function UpdateActionModal(status, result) {
  if (status) {
    LoadFormInputs(modalUpdateMain, result.data.alliedmedia)
  }
}

//Send Update Data Modal
let ActionMainUpdateSend = new QueryAjax({
  form: 'form-update-main',
  action: 'FunctionActionUpdateMain',
  listTable: TableMain,
})
function FunctionActionUpdateMain(status) {
  if (status) {
    notify(
      false,
      'Medio Aliado Actualizado',
      'Operación realizada exitosamente',
      2,
    )
    ActionMainUpdateSend.FormClose()
    TableMain.refresh()
  }
}
