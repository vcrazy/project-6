<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->_set_up();
	}

	private function _set_up()
	{
		$this->data['no_cache'] = microtime(TRUE);
		$this->data['menu'] = "menu/menu";

		if($this->session->userdata('is_logged'))
		{
			$this->load->model('Model_groups');
			$this->data['all_my_groups'] = $this->Model_groups->get_my_all();
		}
	}

	protected function load_view($view_name = 'default_view')
	{
		$this->load->view($view_name, $this->data);
	}
}
