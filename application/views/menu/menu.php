<div class="accordion" id="accordion2">
  <div class="accordion-group remove_border">
    <div class="accordion-heading menu_bottom_border">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        Съобщения
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner remove_border">
        <ul class="nav nav-list">
            <li><a href="#">Изпрати</a></li>
            <li><a href="#">Непрочетени</a></li>
            <li><a href="#">Прочетени</a></li>
            <li><a href="#">Изпратени</a></li>
          </ul>
      </div>
    </div>
  </div>
  <div class="accordion-group remove_border">
    <div class="accordion-heading menu_bottom_border">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        Групи
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner remove_border">
       <ul class="nav nav-list">
			<?php foreach($all_my_groups as $my_group): ?>
				<li>
					<?php if(isset($my_group['group_id'])): ?>
						<a href="/groups/<?php echo $my_group['group_id']; ?>">
							<?php echo $my_group['group_subject']; ?>
						</a>
					<?php else: ?>
						<a href="/specialties/<?php echo $my_group['specialty_id']; ?>">
							<?php echo $my_group['specialty_name']; ?>
						</a>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>