let div = $('#tableMain')
let route = '/admin/specials/list'
let structure = [' ', 'Estado', 'Nombre', 'Url', 'Fecha publicación', '# vistos']

var TableMain = new tableGear(div, route, structure)
TableMain.refresh(true)