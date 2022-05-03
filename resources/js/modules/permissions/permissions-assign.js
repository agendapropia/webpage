let modalAssignPermissions = $('#modal-assign-permissions')
let formAssignPermissions = $('form[name=form-assign-permissions]')

// funtion open modal assign
function AssignPermissions(data) {
  modalAssignPermissions.find('.name_role').text(data.name)
  assignPermissionTable.form.url = '/admin/accounts/roles/' + data.id + '/permissions'
  SendPermissionAssign.url = '/admin/accounts/roles/' + data.id + '/assign'
  assignPermissionTable.refresh(false)
}

// table permissions
let structure_array = [' ', 'Nombre', 'Description', 'Módulo']
var assignPermissionTable = new tableGear(
  $('#assign-permissions'),
  '/admin/accounts/roles/_role_/permissions',
  structure_array,
  'selectedDataPermission',
)
assignPermissionTable.tablePaginate = false
assignPermissionTable.filter.row = 200
assignPermissionTable.modalSelect = modalAssignPermissions

function selectedDataPermission(result) {
  assignPermissionTable.CheckboxSelect(false)
  assignPermissionTable.CheckboxArraySelect('role', 1)
}

// preparate data
function SendDataPermissionsRoles() {
  let remove = []
  let add = []

  $.each(assignPermissionTable.data_complete.data.data, function (elemt, data) {
    if (data.role == 1) {
      if (jQuery.inArray(data.id, assignPermissionTable.checks) == -1) {
        remove.push(data.id)
      }
    } else {
      if (jQuery.inArray(data.id, assignPermissionTable.checks) != -1) {
        add.push(data.id)
      }
    }
  })

  if (remove.length || add.length) {
    SendPermissionAssign.var.remove = remove
    SendPermissionAssign.var.add = add
    SendPermissionAssign.Send()
  } else {
    SendPermissionAssign.FormClose()
  }
}

//Send assign permissions
let SendPermissionAssign = new QueryAjax({
  url: '/admin/accounts/roles/_role_/assign',
  method: 'POST',
  action: 'FinishAssignPermission',
  listTable: assignPermissionTable,
})
function FinishAssignPermission(status, data) {
  if (status) {
    notify(false, 'Permisos Actualizado', 'Operación realizada exitosamente', 2)
    SendPermissionAssign.FormClose()
  }
}
