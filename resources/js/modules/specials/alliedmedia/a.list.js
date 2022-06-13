let div = $('#tableMain')
let route = '/admin/specials/allied-media/list'
let structure = [' ', 'Nombre', 'Url']

var TableMain = new tableGear(div, route, structure)
TableMain.refresh(true)