<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_facebook');
	}

	/**
	 * The whole logout logic goes here 
	 */
	public function index()
	{
		// if logged in FB
		if($this->Model_facebook->is_logged())
		{
			$this->Model_facebook->destroy();
		}

		// then go to the gome page
		header("Location: /");

		exit;
	}
}
