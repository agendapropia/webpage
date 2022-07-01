let div = $('#tableMain')
let route = '/admin/specials/allied-media/list'
let structure = [' ', 'Nombre', 'Url']

var TableMain = new tableGear(div, route, structure)
TableMain.refresh(true)
let modalCreateMain = $('#modal-create-main')
let formCreateMain = $('form[name=form-create-main]')

function ActionMainCreate() {
  UtilFormClose(formCreateMain)
}

//Send data modal
let ActionSendMain = new QueryAjax({
  form: 'form-create-main',
  action: 'FinishActionCreateMain',
  listTable: TableMain,
})
function FinishActionCreateMain(status) {
  if (status) {
    notify(false, 'Medio aliado creado', 'Operación realizada exitosamente', 2)
    ActionSendMain.FormClose()
    TableMain.refresh()
  }
}

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

var modalFiles = $('#modal-utils-imagen-selections')
var divFiles = $('.div-files-class')

var filesClass = new updloadS3(divFiles, {
  url: '/admin/specials/allied-media/files',
  typeFile: 1,
  id: 1,
  reload: false,
  altFunction: "CloseModalFile",
  limitFiles: 1
})

function ActionFilesLoad(data) {
  modalFiles.find('.modal-subtitle').text(`(${data.name})`)

  filesClass.clear()
  filesClass.variables.id = data.id
  filesClass.variables.external_id = data.id
  filesClass.variables.source_id = 1
  filesClass.loading.show()

  ActionQueryFilesList.var.id = data.id
  ActionQueryFilesList.var.type = 1
  ActionQueryFilesList.Send()
}

let ActionQueryFilesList = new QueryAjax({
  url: '/admin/specials/allied-media/files',
  method: 'GET',
  action: 'FinishActionQueryFilesList',
})
function FinishActionQueryFilesList(status, data) {
  if (status) {
    filesClass.loadData(data.data, ActionQueryFilesList.var.id)
  }
  filesClass.loading.hide()
}


function CloseModalFile(){
    modalFiles.modal("hide")
    TableMain.refresh(true)
    notify(false, 'Imagen actualizada', 'Operación realizada exitosamente', 2)
}