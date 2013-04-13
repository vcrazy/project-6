<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_groups');
		$this->load->model('Model_messages');
	}

	public function group($group_id)
	{
		$group = $this->Model_groups->get($group_id);
		$messages = $this->Model_messages->get_group_messages($group_id);

//		var_dump($group);
//		var_dump($messages);

		$this->load_view('');
	}
}
