let div = $('#tableMain')
let route = '/admin/configurations/regions/list'
let structure = [' ', 'Nombre', 'Pais']

var TableMain = new tableGear(div, route, structure)
TableMain.refresh(true)
