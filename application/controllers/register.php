<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// if logged in
		if($this->session->userdata('is_logged'))
		{
			// go to home page
			header("Location: /");
			exit;
		}

		$this->load->model('Model_facebook');
		$this->load->model('Model_user');
	}

	public function index()
	{
		// if we are here we are not logged in the system

		// if we are not logged in FB - go log in and get back here
		if(!$this->Model_facebook->is_logged())
		{
			header("Location: " .
				$this->Model_facebook->get_login_url() .
				$this->Model_facebook->get_scope() .
				$this->Model_facebook->get_redirect_url('/register')
			);
			exit;
		}

		// get my info
		$this->data['me'] = $this->Model_facebook->api('/me');

		// load the registration view
		$this->data['view'] = 'user/register_view';
		$this->load_view();
	}
}
