<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_groups');
	}

	public function group($group_id)
	{
		$group = $this->Model_groups->get($group_id);

		
	}
}
