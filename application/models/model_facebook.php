<?php

class Model_facebook extends MY_Model
{
	private $fb;
	private $scope = 'email'; // comma-separated

	public function __construct()
	{
		parent::__construct();

		require_once APPPATH . 'libraries/facebook/facebook.php';

		$config = array(
			'appId' => '114818515374177',
			'secret' => 'f656f521fbd2b9749b8ce368524e6b77'
		);

		$this->fb = new Facebook($config);
	}

	/**
	 * Checks is user logged in FB
	 * @return boolean
	 */
	public function is_logged()
	{
		return $this->get_user_id() !== 0;
	}

	/**
	 * Returns the login url
	 * @return string
	 */
	public function get_login_url()
	{
		return $this->fb->getLoginUrl();
	}

	/**
	 * Returns the logout url
	 * @return string
	 */
	public function get_logout_url()
	{
		return $this->fb->getLogoutUrl();
	}

	/**
	 * Returns user's id
	 * @return string
	 */
	public function get_user_id()
	{
		return $this->fb->getUser();
	}

	/**
	 * No more FB session
	 */
	public function destroy()
	{
		$this->fb->destroySession();
	}

	public function api($params)
	{
		if(is_array($params))
		{
			return call_user_func_array(array($this->fb, 'api'), $params);
		}
		else
		{
			return call_user_func(array($this->fb, 'api'), $params);
		}
	}

	public function get_scope()
	{
		return '&scope=' . $this->scope;
	}

	public function get_redirect_url($url)
	{
		return '&redirect_url=' . $url;
	}
}
