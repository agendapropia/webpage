let div = $('#tableStores')
let route = '/store-manager/stores/list'
let structure = [' ', 'Estado', 'Nombre', 'Teléfono', 'Tipo']

var StoreTable = new tableGear(div, route, structure)
StoreTable.filter.status = ''
StoreTable.filter.store_types = ''
StoreTable.refresh(true)
