<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_page extends MY_Controller
{
	protected $data;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Model_home_page');
	}
	
	public function index()
	{
                $this->data['menu'] = "menu/menu";
		$this->data['view'] = 'home_page/home_page_view';
		
		$this->load_view();
	}
}
