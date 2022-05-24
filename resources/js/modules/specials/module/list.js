let div = $('#tableMain')
let route = '/admin/specials/list'
let structure = [' ', 'Estado', 'Nombre', 'Fecha publicación', '# vistos']

var TableMain = new tableGear(div, route, structure)
TableMain.refresh(true)
