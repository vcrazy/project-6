<?php// echo validation_errors(); ?>
<form name="send_user" action="/messages/send" method="POST" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputPerson">To</label>
    <div class="controls">
      <?php if(isset($users_to_send)): ?>
        <input type="text" class="span4" style="margin: 0 auto;" id="inputPerson" name="inputPerson" data-provide="typeahead" data-items="4"/>
        <script type="text/javascript">
            var jsonString = '<?php echo $users_to_send?>';
            var jsonObj = $.parseJSON(jsonString);
            var sourceArr = [];

            for (var i = 0; i < jsonObj.length; i++) {
                sourceArr.push(jsonObj[i].label);
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
        <textarea id="InputMessage" name="InputMessage" placeholder="Message" rows="3"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Изпрати</button>
    </div>
  </div>
</form>