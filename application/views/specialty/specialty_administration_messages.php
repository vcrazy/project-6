<?php if(isset($all_messages_from_specialty) && (isset($all_specialties)) && !empty($all_messages_from_specialty)): ?>

<div class="modal hide" id="addBookDialog">
 <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Съобщение</h3>
  </div>
  <div class="modal-body">
    <p>От: <span style="font-size:20px;" id="m_receiver"></span></p>
    <p>До: <span style="font-size:20px;" id="m_sender"></span></p>
    
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
        <?php foreach($all_messages_from_specialty as $message): ?>
        <tr>
            <?php if ( isset($message['student_names']) ): ?>

            <td>
                <?php 
                    if ($i_am==$message['message_from']) {
                        echo 'Вас';
                    } else {
                        echo $message['student_names'];
                    }
                ?>
            </td>
            <td>Администрация</td>
            <td>
              <?php 
                $short_mess=mb_substr($message['message_text'], 0,40);
                if ( strlen($message['message_text'])>40 ) {
                    $short_mess.='...';
                }
                echo '<a data-message="'.$message['message_text'].'" data-receiver="'.$message['student_names'].'" data-sender="@Администрация" title="View full message" class="open-AddBookDialog button_msg" href="#addBookDialog" data-toggle="modal">'.$short_mess.'</a>';
              ?>
            </td>
            <td><?php echo $message['message_date'];?></td>
            <td>
                <?php if(!empty($message['file_path'])): ?>
                    <a href="/file_download?file=<?php echo urlencode($message['file_path']); ?>">
                            <img src="/img/appbar.disk.download.png" alt="Има прикачен файл" title="Има прикачен файл" />
                    </a>
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<div class="alert alert-info">
    Вие нямате съобщения за тази група !
</div>
<?php endif; ?>