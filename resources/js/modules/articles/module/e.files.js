var modalFiles = $('#modal-utils-imagen-selections')

var divFiles = $('.div-files-class')
var selectImageType = $('select[name=image_type]')

var articleFiles = new updloadS3(divFiles, {
  url: '/admin/articles/files',
  typeFile: 1,
  id: 1,
  reload: false,
  limitFiles: 10
})

selectImageType.change(function () {
  articleFiles.clear()
  articleFiles.variables.source_id = $(this).val()
  articleFiles.loading.show()

  ActionQueryFilesList.var.type = $(this).val()
  ActionQueryFilesList.Send()
})

function ActionFilesLoad(data) {
  modalFiles.find('.modal-subtitle').text(`(${data.name})`)
  selectImageType.val(1)

  articleFiles.clear()
  articleFiles.variables.id = data.id
  articleFiles.variables.external_id = data.id
  articleFiles.variables.source_id = 1
  articleFiles.loading.show()

  ActionQueryFilesList.var.id = data.id
  ActionQueryFilesList.var.type = 1
  ActionQueryFilesList.Send()
}

let ActionQueryFilesList = new QueryAjax({
  url: '/admin/articles/files',
  method: 'GET',
  action: 'FinishActionQueryFilesList',
})
function FinishActionQueryFilesList(status, data) {
  if (status) {
    articleFiles.loadData(data.data, ActionQueryFilesList.var.id)
  }
}
