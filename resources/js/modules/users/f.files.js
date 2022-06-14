const modalFiles = $('#modal-utils-imagen-selections')
const divFiles = $('.div-files-class')

var filesClass = new updloadS3(divFiles, {
  url: '/admin/accounts/users/files',
  typeFile: 1,
  id: 1,
  reload: false,
  altFunction: 'CloseModalFile',
  limitFiles: 1,
})

function ActionFilesLoad(data) {
  modalFiles
    .find('.modal-subtitle')
    .text(`(${data.first_name} ${data.last_name})`)

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
  url: '/admin/accounts/users/files',
  method: 'GET',
  action: 'FinishActionQueryFilesList',
})
function FinishActionQueryFilesList(status, data) {
  if (status) {
    filesClass.loadData(data.data, ActionQueryFilesList.var.id)
  }
  filesClass.loading.hide()
}

function CloseModalFile() {
  modalFiles.modal('hide')
  UserTable.refresh(true)
  notify(false, 'Imagen actualizada', 'Operación realizada exitosamente', 2)
}
