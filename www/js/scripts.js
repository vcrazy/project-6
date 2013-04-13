$(document).ready(function(){
	$('#test').dataTable();
        
        $('#sent_messages_table').dataTable();

	$('ul.get_template li a').click(function(){
		$('#InputMessage').html($('#tpl_' + $(this).attr('data-tpl')).tmpl({name: $('#inputPerson').val()}));
		$('#InputMessage').html($('#InputMessage').html().replace(/<br\s*[\/]?>/gi, "\n"));

		$(this).closest('div').find('button').click().blur();

		return false;
	});
        
       $('#send_message_button').click(function () {
        var btn = $(this);
        btn.button('loading');
        setTimeout(function () { 
            btn.button('reset');
        }, 3000);
       });
});
