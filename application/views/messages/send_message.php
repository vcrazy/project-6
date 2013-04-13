<?php// echo validation_errors(); ?>
<form id="send_user" name="send_user" action="/messages/send" method="POST" class="form-horizontal" enctype="multipart/form-data">
  <div class="control-group">
    <label class="control-label" for="inputPerson">To</label>
    <div class="controls">
      <?php if(isset($users_to_send)): ?>
        <input type="text" class="span4" style="margin: 0 auto;" id="inputPerson" name="inputPerson" data-provide="typeahead" data-items="4"/>
        <input type="hidden" id="send_to_id" name="send_to_id" value=""/>
        <input type="hidden" id="is_it_group" name="is_it_group" value=""/>
        <script type="text/javascript">
            var jsonString = '<?php echo $users_to_send?>';
            var jsonObj = $.parseJSON(jsonString);
            var sourceArr = [];
            var asoc_arr=new Array();

            for (var i = 0; i < jsonObj.length; i++) {
                sourceArr.push(jsonObj[i].label);
                var is_it_group=0;
                if ( jsonObj[i].label.match(/^@/) ) {
                    is_it_group=1;
                }
                asoc_arr[jsonObj[i].label]=[jsonObj[i].value,is_it_group];
            }
            
            $("#inputPerson").typeahead({
                source: sourceArr
            });
            
        </script>
      <?php endif; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="InputMessage">Message</label>
    <div class="controls">
        <textarea id="InputMessage" name="InputMessage" placeholder="Message" rows="3" style="width: 400px;"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
		<button type="submit" class="btn">Изпрати</button>
		<div class="btn-group">
			<button class="btn dropdown-toggle" data-toggle="dropdown">
				Използвай темплейт
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu get_template">
				<li><a href="#" data-tpl="gotoroom221">Явете се в стая 221</a></li>
				<li><a href="#" data-tpl="callroom221">Обадете се на отдел "Студенти"</a></li>
				<li><a href="#" data-tpl="unpaidtermtax">Неплатена семестриална такса</a></li>
				<li><a href="#" data-tpl="nextexam">Следващо контролно</a></li>
				<li><a href="#" data-tpl="nextlecture">Ще има ли лекция</a></li>
			</ul>
		</div>
		<?php include_once APPPATH . 'views/templates/templates.html'; ?>
		<input type="file" name="userfile" />
    </div>
  </div>
</form>

<script type="text/javascript">
    $("#send_user").on("submit", function() { 
        var field_value=$('#inputPerson').val();
        if (asoc_arr[field_value]) {
            $('#send_to_id').val(asoc_arr[field_value][0]);
            $('#is_it_group').val(asoc_arr[field_value][1]);
        }
    });
</script>
