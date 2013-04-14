<?php if(isset($all_new_messages) && !empty($all_new_messages)): ?>

<div class="modal hide" id="addBookDialog">
 <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Съобщение</h3>
  </div>
  <div class="modal-body">
    <p>some content</p>
    <input type="text" name="bookId" id="bookId" value=""/>
  </div>
</div>



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
        <?php foreach($all_new_messages as $message): ?>
        <tr>
            <td>Теб</td>
            <?php if ( isset($message['student_names']) ): ?>
            <td><?php echo $message['student_names'];?></td>
            <td>
              <?php 
                $short_mess=mb_substr($message['message_text'], 0,40);
                if ( strlen($message['message_text'])>40 ) {
                    $short_mess.='...';
                }
                echo '<a data-message="'.$message['message_text'].'" data-sender="'.$message['student_names'].'" title="View full message" class="open-AddBookDialog button_msg" href="#addBookDialog" data-toggle="modal">'.$short_mess.'</a>';
              ?>
            </td>
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
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<div class="alert alert-info">
    Вие нямате нови съобщения !
</div>
<?php endif; ?>