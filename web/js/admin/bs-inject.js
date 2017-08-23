$(function() {
	var td = $('<td/>');
	var anchor = '<a href="/admin/components/cp/bshop">'
		+ '<b>'
		+ 'Shop' + ' </b> <i class="icon-arrow-right" style="top:-2px!important;"></i> </a>';

	$(td).html(anchor);
	$('.header-menu-out td').last().after(td);
});