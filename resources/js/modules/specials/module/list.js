let div = $('#tableMain')
let route = '/admin/specials/list'
let structure = [' ', 'Estado', 'Nombre', 'Url', 'Fecha publicación', '# vistos']

var TableMain = new tableGear(div, route, structure)
TableMain.refresh(true)



$('#file_list_box').find('.overlay').hide()

// Campo Files
var filesDocument = new updloadS3($('#modal-utils-imagen-selections'), {
	url: '/document/savefiles',
	typeFile: 1,
	id: 1,
	reload: false,
	altFunction: 'preloadPage'
});

function preloadPage(){
	// location.reload(true);
}