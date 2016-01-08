function changeSize() {
	var width = parseInt($("#Width").val());
	var height = parseInt($("#Height").val());
	$(".add-scroll").width(width).height(height);
	// update scrollbars
	$('.add-scroll').perfectScrollbar('update');
	// or even with vanilla JS!
	Ps.update(document.getElementById('add-scroll'));
}
$(function() {
	$('.add-scroll').perfectScrollbar();
	// with vanilla JS!
	// Ps.initialize(document.getElementById('add-scroll'));
});

// Adiciona slider na barra do menu
$('#app-nav-light-density').slider({ formatter: function(value) { return 'Densidade da luz: ' + value; } });
