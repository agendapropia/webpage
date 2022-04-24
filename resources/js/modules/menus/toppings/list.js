let div = $('#tableMenuToppings')
let route = '/menu-manager/toppings/list'
let structure = [' ', 'Estado', 'Nombre', 'Descripción', 'Tienda']

var MenuToppingTable = new tableGear(div, route, structure)
MenuToppingTable.filter.status = ''
MenuToppingTable.refresh(true)
