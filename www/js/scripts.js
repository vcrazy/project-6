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
        }, 15000);
       });

       if(typeof socket != 'undefined'){
		socket.on('message', function(data){
			$('body').append('<div class="modal modal_rt"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>Получихте ново лично съобщение</h3></div><div class="modal-body"><p>Получихте ново лично съобщение от ' + $.parseJSON(data.from_user) + '</p><p>' + $.parseJSON(data.text) + '</p></div><div class="modal-footer"><a href="#" class="btn close_modal">Затвори</a></div></div>');
			$('.modal_rt').hide().fadeIn('slow');
		});
       }

	$('body').on('click', '.close_modal, .modal-header .close', function(){
		$('.modal, .modal_rt').hide();
	});

        $('body').on('click', '.button_msg', function () {
            var fromperson = $(this).data('sender');
            var tocperson = $(this).data('receiver');
            
            var mymess = $(this).data('message');
            var mymessid = $(this).data('message_id');
            
            if ( mymessid ) {
                $.ajax({
                    url: "/messages/make_read",
                    type: "post",
                    data: {"message_id": mymessid},
//                    success: function(){
//                        alert("success");
//                         $("#result").html('submitted successfully');
//                    },
//                    error:function(){
//                        alert("failure");
//                        $("#result").html('there is error while submit');
//                    }   
                  }); 
            }
            
            $('#m_sender').html(fromperson);
            $('#m_receiver').html(tocperson);
            $('#m_message').html(mymess);
            $('#m_sender_name').val(fromperson);
            $('#addBookDialog').modal('show');
        });
        
//	$('body').on('click', '.button_msg', function () {
//		var fromperson = $(this).data('sender');
//		var tocperson = $(this).data('receiver');
//
//		var mymess = $(this).data('message');
//		var mymessid = $(this).data('message_id');
//
//		$('#m_sender').html(fromperson);
//		$('#m_receiver').html(tocperson);
//		$('#m_message').html(mymess);
//		$('#m_sender_name').val(fromperson);
//		$('#addBookDialog').modal('show');
//	});

	function enterWebPage($time){
		setTimeout(function(){

			$("#bgr-transition").show();
			$("#magenta").hide();
			$("#cyan").hide();
			$("#yellow").hide();
			$("#green").hide();
			$("#bgr").hide();
			$("#main").animate({width: '40980px', height: '23040px', top: '-1650%', left: '-930%' }, 1500);
		}, $time);
	}

	function revealLogo(){
		$('#full_effect').show();
		$("#magenta").animate({top: "265px", left: "402px"}, 700);
		$("#cyan").animate({top: "376px", left: "466px"}, 700);
		$("#yellow").animate({top: "446px", left: "285px"}, 700);
		$("#green").animate({top: "166px", left: "284px"}, 700, function() {
			$("#meesssenger").animate({top: "110px", left: "590px", opacity: 1}, 1200, function(){ enterWebPage(300); });
		});

		setTimeout(function(){
			$('#full_effect').remove();
		}, 3700);
	}

	if(typeof $.cookie('logo_shown6') == 'undefined'){
		$.cookie('logo_shown6', 1);
		revealLogo();
	}
>>>>>>> 7d1866badcbf9cf7b5140d70443a2f31a9d57e27
});
