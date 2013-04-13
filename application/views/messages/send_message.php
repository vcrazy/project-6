<?php// echo validation_errors(); ?>
<form name="send_user" action="/messages/send" method="POST" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputPerson">To</label>
    <div class="controls">
      <input type="text" name="inputPerson" id="inputPerson" placeholder="Person">
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
      <button type="submit" class="btn">Sign in</button>
    </div>
  </div>
</form>