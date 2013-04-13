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
		$this->db->select('student_id');
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
}
