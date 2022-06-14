var modalFiles = $('#modal-utils-imagen-selections')

var divFiles = $('.div-files-class')
var selectImageType = $('select[name=image_type]')

var specialFiles = new updloadS3(divFiles, {
  url: '/admin/specials/files',
  typeFile: 1,
  id: 1,
  reload: false,
  limitFiles: 10
})

selectImageType.change(function () {
  specialFiles.clear()
  specialFiles.variables.source_id = $(this).val()
  specialFiles.loading.show()

  ActionQueryFilesList.var.type = $(this).val()
  ActionQueryFilesList.Send()
})

function ActionFilesLoad(data) {
  modalFiles.find('.modal-subtitle').text(`(${data.name})`)
  selectImageType.val(1)

  specialFiles.clear()
  specialFiles.variables.id = data.id
  specialFiles.variables.external_id = data.id
  specialFiles.variables.source_id = 1
  specialFiles.loading.show()

  ActionQueryFilesList.var.id = data.id
  ActionQueryFilesList.var.type = 1
  ActionQueryFilesList.Send()
}

let ActionQueryFilesList = new QueryAjax({
  url: '/admin/specials/files',
  method: 'GET',
  action: 'FinishActionQueryFilesList',
})
function FinishActionQueryFilesList(status, data) {
  if (status) {
    specialFiles.loadData(data.data, ActionQueryFilesList.var.id)
  }
}
