<?php

class Model_facebook extends MY_Model
{
//	private $fb;
//	private $scope = 'email'; // comma-separated

//	public function __construct()
//	{
//		parent::__construct();
//
//		require_once APPPATH . 'libraries/facebook/facebook.php';
//
//		$config = array();
//		$config['appId'] = '114818515374177';
//		$config['secret'] = 'f656f521fbd2b9749b8ce368524e6b77';
//
//		$this->fb = new Facebook($config);
//	}

	public function index()
	{
		return $this->get_user_id() !== 0;
	}

}
