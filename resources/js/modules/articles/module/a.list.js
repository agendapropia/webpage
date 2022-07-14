let div = $('#tableMain')
let route = '/admin/articles/list'
let structure = [' ', 'Estado', 'Nombre', 'Tipo', 'Url', 'Fecha publicación', '# vistos']

var TableMain = new tableGear(div, route, structure)
TableMain.filter.special_id = ''
TableMain.filter.status_id = ''
TableMain.refresh(true)