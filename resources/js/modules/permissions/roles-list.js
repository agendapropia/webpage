let div = $('#tableRoles')
let route = '/accounts/roles/list'
let structure = [' ', 'Nombre', 'Description', 'guard_name']

var roleTable = new tableGear(div, route, structure)
roleTable.filter.status = ''
roleTable.refresh(true)
