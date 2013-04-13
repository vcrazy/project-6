<?php

class Model_specialties extends MY_Model
{
	public function get($sp_id)
	{
		$this->db->select('*');
		$this->db->from('specialties');
		$this->db->where('specialty_id', $sp_id);
		$this->db->limit(1);
		$query = $this->db->get();

		return $this->results($query);
	}
}
