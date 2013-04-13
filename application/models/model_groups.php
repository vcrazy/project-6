<?php

class Model_groups extends MY_Model
{
	public function get($group_id)
	{
		$this->db->select('*');
		$this->db->from('groups');
		$this->db->where('group_id', $group_id);
		$this->db->limit(1);
		$query = $this->db->get();

		return $this->results($query);
	}

	public function get_my()
	{
		$group_ids = $this->get_my_group_ids();

		$this->db->select('*');
		$this->db->from('groups');
		$this->db->where_in('group_id', $group_ids);
		$query = $this->db->get();

		return $this->results($query);
	}

	public function get_my_group_ids()
	{
		
		$user = $this->session->userdata('user');

		$this->db->select('group_id');
		$this->db->from('group_students');
		$this->db->where('student_id', $user['student_id']);
		$query = $this->db->get();

		return $this->single($query, 'group_id');
	}

	public function get_my_special()
	{
		$user = $this->session->userdata('user');

		$this->db->select('student_specialty_id');
		$this->db->from('students');
		$this->db->where('student_id', $user['student_id']);
		$this->db->limit(1);
		$query = $this->db->get();

		$student_specialty_id = $this->single($query, 'student_specialy_id');

		$this->db->select('*');
		$this->db->from('specialties');
		$this->db->where('specialty_id', $student_specialty_id);
		$query = $this->db->get();

		return $this->results($query);
	}

	public function get_special()
	{
		return array(
			'specialty_id' => 0,
			'specialty_name' => 'Администрация',
			'specialty_degree' => '',
			'specialty_active' => 1
		);
	}

	public function get_my_all()
	{
		return array_merge($this->get_my(), $this->get_my_special(), $this->get_special());
	}
}
