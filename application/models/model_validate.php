<?php

class Model_validate extends MY_Model
{
	public function validate_student($id)
	{
            $query = $this->db->get_where('students', array('student_id' => $id));
            if ($query->num_rows() > 0)
            {
                return true;
            }
            return false;
	}
        
        public function validate_student_is_in_group($id,$group_id)
	{
            
	}
}
