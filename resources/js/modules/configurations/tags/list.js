let div = $('#tableMain')
let route = '/admin/configurations/tags/list'
let structure = [' ', 'Nombre', 'Code']

var TableMain = new tableGear(div, route, structure)
TableMain.refresh(true)
