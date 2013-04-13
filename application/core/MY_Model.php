<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected function results($query)
	{
		if(!$query->num_rows()) return FALSE;

		$arr = array();

		foreach($query->result_array() as $row)
		{
			$arr[] = $row;
		}

		return $arr;
	}

	protected function single_result($query)
	{
		if(!$query->num_rows()) return FALSE;

		return $query->row_array();
	}

	protected function single($query, $col)
	{
		if(!$query->num_rows()) return FALSE;

		return $query->row()->$col;
	}

	protected function to_array_single($query, $col)
	{
		if(!$query->num_rows()) return array();

		$arr = array();

		foreach($query->result_array() as $row)
		{
			$arr[] = $row[$col];
		}

		return $arr;
	}
}
