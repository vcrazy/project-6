<?php

class Model_user extends MY_Model
{
	public function user_exists($fb_user_id)
	{
		$this->db->select('student_id');
		$this->db->from('students');
		$this->db->where('student_fb_id', $fb_user_id);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->num_rows() > 0;
	}

	public function register($fb_user)
	{
		return $this->db->insert('students', array(
			'student_fb_id' => $fb_user['id'],
			'student_email' => $fb_user['email'],
			'student_fn' => mt_rand(10000, 99999),
			'student_course_year' => mt_rand(1, 4),
			'student_specialty_id' => mt_rand(1, 5),
			'student_degree' => 'Бакалавър',
			'student_names' => $fb_user['name'],
			'student_phone' => '088' . mt_rand(1000000, 9999999)
		));
	}

	public function login($fb_user_id)
	{
		$this->db->select('*');
		$this->db->from('students');
		$this->db->where('student_fb_id', $fb_user_id);
		$this->db->limit(1);
		$query = $this->db->get();

		$user = $this->single_result($query);

		$this->session->set_userdata('is_logged', TRUE);
		$this->session->set_userdata('user', $user);
	}

	public function logout()
	{
		$this->session->sess_destroy();
	}
        
        public function load_users($groups_ids,$specialties_ids)
	{
            $session=$this->session->userdata('user');
            $user=$session['student_id'];
            $return_students=array();
            $users=array();
            if (!empty($groups_ids)) {
                $this->db->select('students.student_id,students.student_names');
                $this->db->from('group_students');
                $this->db->join('students', 'group_students.student_id = students.student_id', 'left');
                $this->db->where('group_students.student_id !=', $user);
                $this->db->where_in('group_students.group_id', $groups_ids);
                $query = $this->db->get();
                $return_students=$this->results($query);
            }
            
            if (!empty($specialties_ids)) {
                $this->db->select('student_id,student_names');
                $this->db->from('students');
                $this->db->where('student_id !=', $user);
                $this->db->where_in('student_specialty_id', $specialties_ids);
                $query = $this->db->get();
                $specialty_array=$this->results($query);
                if ( !empty($specialty_array) ) {
                    if (!empty($return_students)) {
                        $return_students=array_merge($return_students,$specialty_array);
                    }
                }
            }
            
            return $return_students;
        }
        
        public function get_speciality_by_id() {
            $session=$this->session->userdata('user');
            $speciality_id=$session['student_specialty_id'];
            
            $this->db->select('specialty_name');
            $this->db->from('specialties');
            $this->db->where('specialty_id', $speciality_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->first_row();
                return $row->specialty_name;
            }
            
            return false;
        }
}
