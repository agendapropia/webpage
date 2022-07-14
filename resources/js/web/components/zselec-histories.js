$("select").change(function () {
	$('div.histories').hide();
		$('div.histories.'+$(this).val()).show();
});