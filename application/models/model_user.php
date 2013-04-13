<?php

class Model_user extends MY_Model
{
	public function load_users($user=array())
	{
            $return_students=array();
            $this->db->select('student_id,student_names');
            $this->db->where_not_in('student_id', $user);
            $query = $this->db->get('students');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row)
                    {
                        $return_students[]=$row;
                    }
            }
            return $return_students;
	}
}
