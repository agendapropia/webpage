let div = $('#tableMenuCategories')
let route = '/menu-manager/categories/list'
let structure = [' ', 'Estado', 'Nombre', 'Categoría', 'Tienda']

var MenuCategoriesTable = new tableGear(div, route, structure)
MenuCategoriesTable.filter.status = ''
MenuCategoriesTable.refresh(true)
