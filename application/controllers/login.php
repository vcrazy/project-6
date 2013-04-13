<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_facebook');
	}

	/**
	 * The whole login logic goes here 
	 */
	public function index()
	{
		// if not logged in FB
		if(!$this->Model_facebook->is_logged())
		{
			// go log in
			header("Location: " . $this->Model_facebook->get_login_url() . $this->Model_facebook->get_scope());
		}
		else // if logged in FB
		{
			// go to the home page
			header("Location: /");
		}

		exit;
	}
}
