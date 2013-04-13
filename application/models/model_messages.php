<?php

class Model_messages extends MY_Model
{       
	public function send($data)
	{
            $data = array(
                'message_from' => $data['person_from'] ,
                'message_to' => $data['person_to'],
                'message_text' => $data['message'],
                'message_date'=> $data['date'],
                'group_id'=>  $data['is_group']
             );
            $this->db->insert('messages', $data);
	}
}
