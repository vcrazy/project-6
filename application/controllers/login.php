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
			exit;
		}
		else // if logged in FB
		{
			// if !user
			if(!$this->Model_user->user_exists($this->Model_facebook->get_user_id()))
			{
				// register
				$this->Model_user->register($this->Model_facebook->api('/me'));
			}

			$this->Model_user->login($this->Model_facebook->get_user_id());
			header("Location: /");
		}

		exit;
	}
}
