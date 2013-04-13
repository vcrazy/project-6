$(document).ready(function(){
	$('#test').dataTable();

	$('ul.get_template li a').click(function(){
		$('#InputMessage').html($('#tpl_' + $(this).attr('data-tpl')).tmpl({name: $('#inputPerson').val()}));
		$('#InputMessage').html($('#InputMessage').html().replace(/<br\s*[\/]?>/gi, "\n"));

		$(this).closest('div').find('button').click().blur();

		return false;
	});
});
