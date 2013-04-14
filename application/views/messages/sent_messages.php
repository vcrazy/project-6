<?php if(isset($all_sent_messages) && !empty($all_sent_messages)): ?>
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
        <?php foreach($all_sent_messages as $message): ?>
        <tr>
            <td>Теб</td>
            <?php if ( isset($message['student_names']) ): ?>
            <td><?php echo $message['student_names'];?></td>
            <td><?php echo mb_substr($message['message_text'], 0,40); if (strlen($message['message_text'])>40) echo '...';?></td>
            <td><?php echo $message['message_date'];?></td>
            <?php elseif ( isset($message['specialty_name']) ): ?>
            <td><?php echo $message['specialty_name'];?></td>
            <td><?php echo mb_substr($message['message_text'], 0,40); if (strlen($message['message_text'])>40) echo '...'?></td>
            <td><?php echo $message['message_date'];?></td>
            <?php else: ?>
            <td><?php echo $message['group_subject'];?></td>
            <td><?php echo mb_substr($message['message_text'], 0,40); if (strlen($message['message_text'])>40) echo '...'?></td>
            <td><?php echo $message['message_date'];?></td>
            <?php endif; ?>
            <td><?php if (!empty($message['file_path'])) {echo '<a href="#"><img src="/img/appbar.disk.download.png" alt="Има прикачен файл"/></a>';}?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<div class="alert alert-info">
    Вие нямате изпратени съобщения !
</div>
<?php endif; ?>