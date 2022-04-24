let modalAssignRoles = $('#modal-assign-roles')

// funtion open modal assign
function AssignRoles(data) {
  modalAssignRoles
    .find('.name_user')
    .text(data.first_name + ' ' + data.last_name)
  assignRolesTable.form.url = '/accounts/users/' + data.id + '/roles'
  SendRolesAssign.url = '/accounts/users/' + data.id + '/assign'
  assignRolesTable.refresh(false)
}

// table permissions
let structure_array = [' ', 'Nombre', 'Description']
var assignRolesTable = new tableGear(
  $('#assign-roles'),
  '/accounts/roles/_role_/permissions',
  structure_array,
  'selectedDataRoles',
)
assignRolesTable.tablePaginate = false
assignRolesTable.filter.row = 200

function selectedDataRoles(result) {
  assignRolesTable.CheckboxSelect(false)
  assignRolesTable.CheckboxArraySelect('role', 1)
}

// preparate data
function SendDataUserRoles() {
  let remove = []
  let add = []

  $.each(assignRolesTable.data_complete.data.data, function (elemt, data) {
    if (data.role == 1) {
      if (jQuery.inArray(data.id, assignRolesTable.checks) == -1) {
        remove.push(data.id)
      }
    } else {
      if (jQuery.inArray(data.id, assignRolesTable.checks) != -1) {
        add.push(data.id)
      }
    }
  })

  if (remove.length || add.length) {
    SendRolesAssign.var.remove = remove
    SendRolesAssign.var.add = add
    SendRolesAssign.Send()
  } else {
    SendRolesAssign.FormClose()
  }
}

//Send assign permissions
let SendRolesAssign = new QueryAjax({
  url: '/accounts/roles/_role_/assign',
  method: 'POST',
  action: 'FinishAssignRoles',
  listTable: UserTable,
})
function FinishAssignRoles(status, data) {
  if (status) {
    notify(false, 'Roles Actualizado', 'Operación realizada exitosamente', 2)
    SendRolesAssign.FormClose()
  }
}
