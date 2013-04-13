		<?php include('foot.php'); ?>
		<br />
		<?php include('benchmark.php'); ?>
		<?php if($this->session->userdata('is_logged')): ?>
			<script src="http://project-6.loc:8742/socket.io/socket.io.js" type="text/javascript"></script>
			<script type="text/javascript">
				var socket = io.connect('http://project-6.loc:8742');
				socket.emit('me', {user_id: <?php $user = $this->session->userdata('user'); echo $user['student_id']; ?>});

				var sent_message = <?php echo isset($sent_message) && $sent_message ? 1 : 0; ?>,
					sent_to_user_id = <?php echo isset($sent_to_user_id) && $sent_to_user_id ? $sent_to_user_id : 0; ?>;

				if(sent_message && sent_to_user_id){
					socket.emit('message', {to_user: sent_to_user_id, text: 'test text', from_user: 'Ivan'});
				}
			</script>
		<?php endif; ?>
	</body>
</html>
