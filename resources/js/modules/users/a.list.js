let div = $('#tableUsers')
let route = '/admin/accounts/users/list'
let structure = [' ', 'Estado', 'Nombre', 'Teléfono', 'Idioma']

var UserTable = new tableGear(div, route, structure)
UserTable.filter.status = ''
UserTable.refresh(true)
