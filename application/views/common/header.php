<?php include('head.php'); ?>
<div class="our_header navbar-static-top page-header remove_margin">
	<div id="header_holder">
		<div id="header_links">
			<?php if($this->session->userdata('is_logged')): ?>
				<a href="/logout">Изход</a>
			<?php else: ?>
				<a href="/login">Вход</a>
			<?php endif; ?>
		</div>
	</div>
</div>