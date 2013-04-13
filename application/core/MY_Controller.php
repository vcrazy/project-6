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
		$this->data['menu'] = "menu/menu-not-logged";
		$this->data['content_title'] = '6 Messenger';

		if($this->session->userdata('is_logged'))
		{
			$this->load->model('Model_groups');
			$this->data['all_my_groups'] = $this->Model_groups->get_my_all();
			$this->data['menu'] = "menu/menu";
		}

		$this->data['active'] = array(
			'controller' => $this->router->fetch_class(),
			'method' => $this->router->fetch_method(),
			'param' => $this->uri->segment(2)
		);
	}

	protected function load_view($view_name = 'default_view')
	{
		$this->load->view($view_name, $this->data);
	}
}
