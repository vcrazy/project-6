<?php if(isset($all_unread_messages) && !empty($all_unread_messages)): ?>
<table id="sent_messages_table">
    <thead>
        <tr>
            <th>От</th>
            <th>До</th>
            <th>Съобщение</th>
            <th>Дата</th>
            <th>Файл</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($all_unread_messages as $message): ?>
        <tr>
            <?php if ( isset($message['student_names']) ): ?>

            <td><?php echo $message['student_names'];?></td>
            <td>Теб</td>
            <td><?php echo mb_substr($message['message_text'], 0,40); if (strlen($message['message_text'])>40) echo '...';?></td>
            <td><?php echo $message['message_date'];?></td>

            <?php elseif ( isset($message['specialty_name']) ): ?>

            <td><?php echo $message['specialty_name'];?></td>
            <td>Теб</td>
            <td><?php echo mb_substr($message['message_text'], 0,40); if (strlen($message['message_text'])>40) echo '...';?></td>
            <td><?php echo $message['message_date'];?></td>

            <?php else: ?>

            <td><?php echo $message['group_subject'];?></td>
            <td>Теб</td>
            <td><?php echo mb_substr($message['message_text'], 0,40); if (strlen($message['message_text'])>40) echo '...';?></td>
            <td><?php echo $message['message_date'];?></td>
            <?php endif; ?>
            <td>
				<?php if(!empty($message['file_path'])): ?>
					<a href="/file_download?file=<?php echo urlencode($message['file_path']); ?>">
						<img src="/img/appbar.disk.download.png" alt="Има прикачен файл" title="Има прикачен файл" />
					</a>
				<?php endif; ?>
			</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<div class="alert alert-info">
    Вие нямате прочетени съобщения !
</div>
<?php endif; ?>