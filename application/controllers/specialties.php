<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Specialties extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_specialties');
		$this->load->model('Model_messages');
	}

	public function specialty($sp_id)
	{
		$group = $this->Model_specialties->get($sp_id);
		$messages = $this->Model_messages->get_specialty_messages($sp_id);

//		var_dump($group);
//		var_dump($messages);

		$this->load_view();
	}
}
