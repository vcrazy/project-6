<div class="accordion" id="accordion2">
  <div class="accordion-group remove_border">
    <div class="accordion-heading menu_bottom_border">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        <img src="/img/messages.png" alt="Съобщения" />
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse <?php if($active['controller'] != 'groups' && $active['controller'] != 'specialties') echo 'in'; ?>">
      <div class="accordion-inner">
        <ul class="nav nav-list messages">
			<li <?php if($active['controller'] == 'messages' && $active['method'] == 'index') echo 'class="active"'; ?>><a href="/messages/send">Последни</a></li>
            <li <?php if($active['controller'] == 'messages' && $active['method'] == 'send') echo 'class="active"'; ?>><a href="/messages/send">Изпрати</a></li>
            <li <?php if($active['controller'] == 'messages' && $active['method'] == 'inbox') echo 'class="active"'; ?>><a href="/messages/inbox">Непрочетени</a></li>
            <li <?php if($active['controller'] == 'messages' && $active['method'] == 'read') echo 'class="active"'; ?>><a href="/messages/read">Прочетени</a></li>
            <li <?php if($active['controller'] == 'messages' && $active['method'] == 'sent') echo 'class="active"'; ?>><a href="/messages/sent">Изпратени</a></li>
          </ul>
      </div>
    </div>
  </div>
  <div class="accordion-group remove_border">
    <div class="accordion-heading menu_bottom_border">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        <img src="/img/groups.png" alt="Групи" />
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse <?php if($active['controller'] == 'groups' || $active['controller'] == 'specialties') echo 'in'; ?>">
      <div class="accordion-inner">
       <ul class="nav nav-list groups">
			<?php foreach($all_my_groups as $my_group): ?>
				<?php if(isset($my_group['group_id'])): ?>
					<li <?php if($active['controller'] == 'groups' && $active['param'] == $my_group['group_id']) echo 'class="active"'; ?>>
						<a href="/groups/<?php echo $my_group['group_id']; ?>">
							<?php echo $my_group['group_subject']; ?>
						</a>
					</li>
					<?php else: ?>
					<li <?php if($active['controller'] == 'specialties' && $active['param'] == $my_group['specialty_id']) echo 'class="active"'; ?>>
						<a href="/specialties/<?php echo $my_group['specialty_id']; ?>">
							<?php echo $my_group['specialty_name']; ?>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>