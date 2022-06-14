let div = $('#tablePermissions')
let route = '/admin/accounts/permissions/list'
let structure = [' ', 'Nombre', 'Description', 'Módulo', 'guard_name']

var permissionTable = new tableGear(div, route, structure)
permissionTable.filter.modules = ''
permissionTable.refresh(true)
