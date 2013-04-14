<?php if(isset($all_sent_messages)): ?>
<table id="sent_messages_table">
    <thead>
        <tr>
            <th>От</th>
            <th>До</th>
            <th>Съобщение</th>
            <th>Дата</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($all_sent_messages as $message): ?>
        <tr>
            <td>Теб</td>
            <?php if ( isset($message['student_names']) ): ?>
            <td><?php echo $message['student_names'];?></td>
            <td><?php echo $message['message_text'];?></td>
            <td><?php echo $message['message_date'];?></td>
            <?php else: ?>
            <td><?php echo $message['group_subject'];?></td>
            <td><?php echo $message['message_text'];?></td>
            <td><?php echo $message['message_date'];?></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>