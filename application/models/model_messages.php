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
                'group_id'=>  $data['is_group'],
				'file_path' => $data['file_path']
             );
            $this->db->insert('messages', $data);
	}

	public function get_group_messages($group_id)
	{
		$this->db->select('*');
		$this->db->from('messages');
		$this->db->where('group_id', $group_id);
		$query = $this->db->get();

		return $this->results($query);
	}
        
        public function get_sent_messages()
        {
            $session=$this->session->userdata('user');
            $user=$session['student_id'];
            $this->db->select('*');
            $this->db->from('messages');
            $this->db->where('message_from', $user);
            $query = $this->db->get();

            return $this->results($query);
        }
}
