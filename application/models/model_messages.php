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
                'speciality_id'=>  $data['is_speciality'],
                'group_id'=>  $data['is_group'],
		'file_path' => isset($data['file_path']) ? $data['file_path'] : ''
             );
            return $this->db->insert('messages', $data);
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
            
            $result_array=array();
            
            $this->db->select('students.student_names,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('students', 'messages.message_to=students.student_id');
            $this->db->where('messages.message_from', $user);
            $this->db->where('messages.message_to >',0);
            $query = $this->db->get();

            $result_array=$this->results($query);
            
            $this->db->select('groups.group_subject,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('groups', 'messages.group_id = groups.group_id');
            $this->db->where('messages.message_from', $user);
            $this->db->where('messages.message_to >',0);
            $query = $this->db->get();
            
            $specialty_array=$this->results($query);
            if ( !empty($specialty_array) ) {
                if (!empty($result_array)) {
                    $result_array=array_merge($result_array,$specialty_array);
                } else {
                    $result_array=$specialty_array;
                }
            }
            $this->db->select('specialties.specialty_name,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('specialties', 'messages.speciality_id = specialties.specialty_id');
            $this->db->where('messages.message_from', $user);
            $this->db->where('messages.speciality_id >',0);
            $query = $this->db->get();
            
            $specialty_array=$this->results($query);
            
            if ( !empty($specialty_array) ) {
                if (!empty($result_array)) {
                    $result_array=array_merge($result_array,$specialty_array);
                } else {
                    $result_array=$specialty_array;
                }
            }
            
           return $result_array;
        }
        
        public function get_new_messages() 
        {
            $session=$this->session->userdata('user');
            $user=$session['student_id'];
            
            $result_array=array();
            
            $this->db->select('students.student_names,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('students', 'messages.message_from=students.student_id');
            $this->db->where('messages.message_from !=', $user);
            $this->db->where('messages.message_is_read', 0);
            $this->db->where('messages.message_to >',0);
            $query = $this->db->get();

            $result_array=$this->results($query);
            
            $this->db->select('groups.group_subject,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('groups', 'messages.group_id = groups.group_id');
            $this->db->where('messages.message_from !=', $user);
            $this->db->where('messages.message_is_read', 0);
            $this->db->where('messages.message_to >',0);
            $query = $this->db->get();
            
            $specialty_array=$this->results($query);
            if ( !empty($specialty_array) ) {
                if (!empty($result_array)) {
                    $result_array=array_merge($result_array,$specialty_array);
                } else {
                    $result_array=$specialty_array;
                }
            }
            $this->db->select('specialties.specialty_name,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('specialties', 'messages.speciality_id = specialties.specialty_id');
            $this->db->where('messages.message_from !=', $user);
            $this->db->where('messages.message_is_read', 0);
            $this->db->where('messages.speciality_id >',0);
            $query = $this->db->get();
            
            $specialty_array=$this->results($query);
            
            if ( !empty($specialty_array) ) {
                if (!empty($result_array)) {
                    $result_array=array_merge($result_array,$specialty_array);
                } else {
                    $result_array=$specialty_array;
                }
            }
            
           return $result_array;
        }
        
        public function get_unread_messages() 
        {
            $session=$this->session->userdata('user');
            $user=$session['student_id'];
            
            $result_array=array();
            
            $this->db->select('students.student_names,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('students', 'messages.message_from=students.student_id');
            $this->db->where('messages.message_from !=', $user);
            $this->db->where('messages.message_is_read >', 0);
            $this->db->where('messages.message_to >',0);
            $query = $this->db->get();

            $result_array=$this->results($query);
            
            $this->db->select('groups.group_subject,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('groups', 'messages.group_id = groups.group_id');
            $this->db->where('messages.message_from !=', $user);
            $this->db->where('messages.message_is_read >', 0);
            $this->db->where('messages.message_to >',0);
            $query = $this->db->get();
            
            $specialty_array=$this->results($query);
            if ( !empty($specialty_array) ) {
                if (!empty($result_array)) {
                    $result_array=array_merge($result_array,$specialty_array);
                } else {
                    $result_array=$specialty_array;
                }
            }
            $this->db->select('specialties.specialty_name,messages.message_text,messages.message_date,messages.group_id');
            $this->db->from('messages');
            $this->db->join('specialties', 'messages.speciality_id = specialties.specialty_id');
            $this->db->where('messages.message_from !=', $user);
            $this->db->where('messages.message_is_read >', 0);
            $this->db->where('messages.speciality_id >',0);
            $query = $this->db->get();
            
            $specialty_array=$this->results($query);
            
            if ( !empty($specialty_array) ) {
                if (!empty($result_array)) {
                    $result_array=array_merge($result_array,$specialty_array);
                } else {
                    $result_array=$specialty_array;
                }
            }
            
           return $result_array;
        }
}
