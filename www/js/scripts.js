$(document).ready(function(){
	$('#test').dataTable();
        
        $('#sent_messages_table').dataTable(
            {"bAutoWidth": false,
            "aoColumns": [
                           { "sWidth": "15%" },
                           { "sWidth": "15%" },
                           { "sWidth": "40%" },
                           { "sWidth": "20%" },
                           { "sWidth": "10%" }
                       ]
        });

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

	if(typeof socket != 'undefined'){
		socket.on('message', function(data){
			$('body').append('<div class="modal"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>Получихте ново лично съобщение</h3></div><div class="modal-body"><p>Получихте ново лично съобщение от ' + $.parseJSON(data.from_user) + '</p><p>' + $.parseJSON(data.text) + '</p></div><div class="modal-footer"><a href="#" class="btn close_modal">Затвори</a></div></div>');
			$('.modal').hide().fadeIn('slow');
		});
	}

	$('body').on('click', '.close_modal, .modal-header .close', function(){
		$('.modal').remove();
	});
        
//        $('body').on("click",'.button_msg', function () {
//            var myBookId = $(this).data('id');
//            $(".modal-body #bookId").val( myBookId );
//            $('#addBookDialog').modal('show');
//       });

        $('.button_msg').click( function () {
                    var myperson = $(this).data('sender');
                    var mymess = $(this).data('message');
                    alert(myperson);
                    alert(mymess);
                    $('#addBookDialog').modal('show');
               });
        
        
        
        
});
