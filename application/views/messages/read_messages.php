<?php if(isset($all_unread_messages) && !empty($all_unread_messages)): ?>
<div class="modal hide" id="addBookDialog">
 <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Съобщение</h3>
  </div>
  <div class="modal-body">
    <p>От: <span style="font-size:20px;" id="m_sender"></span></p>
    <p>До: <span style="font-size:20px;" id="m_receiver">Вас</span></p>
    
    <p>Съобщение:<br/> <span style="font-size:20px;" id="m_message"></span></p>
    <form action="/messages/send" method="GET">
        <input type="hidden" id="m_sender_name" name="m_sender_name" value=""/>
        <button id="send_message_button" type="submit" class="btn btn-primary">Изпрати отговор</button>
        <button type="button" data-dismiss="modal">Close</button>
    </form>
    
  </div>
</div>

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
            <td>
                <?php 
                $short_mess=mb_substr($message['message_text'], 0,40);
                if ( strlen($message['message_text'])>40 ) {
                    $short_mess.='...';
                }
                echo '<a data-message="'.$message['message_text'].'" data-receiver="Теб" data-sender="'.$message['student_names'].'" title="View full message" class="open-AddBookDialog button_msg" href="#addBookDialog" data-toggle="modal">'.$short_mess.'</a>';
              ?>
            </td>
            <td><?php echo $message['message_date'];?></td>
            <?php elseif ( isset($message['specialty_name']) ): ?>
            <td><?php echo $message['specialty_name'];?></td>
            <td>Теб</td>
            <td>
                <?php
                    $short_mess=mb_substr($message['message_text'], 0,40);
                    if ( strlen($message['message_text'])>40 ) {
                        $short_mess.='...';
                    }
                    echo '<a data-message="'.$message['message_text'].'" data-receiver="Теб" data-sender="'.$message['specialty_name'].'" title="View full message" class="open-AddBookDialog button_msg" href="#addBookDialog" data-toggle="modal">'.$short_mess.'</a>';
                ?>
                <?php // echo mb_substr($message['message_text'], 0,40); if (strlen($message['message_text'])>40) echo '...';?>
            </td>
            <td><?php echo $message['message_date'];?></td>
            <?php else: ?>
            <td><?php echo $message['group_subject'];?></td>
            <td>Теб</td>
            <td>
                <?php
                    $short_mess=mb_substr($message['message_text'], 0,40);
                    if ( strlen($message['message_text'])>40 ) {
                        $short_mess.='...';
                    }
                    echo '<a data-message_id="'.$message['message_id'].'" data-message="'.$message['message_text'].'" data-receiver="Теб" data-sender="'.$message['group_subject'].'" title="View full message" class="open-AddBookDialog button_msg" href="#addBookDialog" data-toggle="modal">'.$short_mess.'</a>';
                ?>
            </td>
            <td><?php echo $message['message_date'];?></td>
            <?php endif; ?>
            <td><?php if (!empty($message['file_path'])) {echo '<a href="#"><img src="/img/appbar.disk.download.png" alt="Има прикачен файл"/></a>';}?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<div class="alert alert-info">
    Вие нямате прочетени съобщения !
</div>
<?php endif; ?>