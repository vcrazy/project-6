<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_download extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->download();
		exit;
	}

	public function download()
	{
		$this->load->helper('download');

		$file = $_GET['file'];
		$file_exploded = explode('/', $file);

		if(!file_exists(APPPATH . '../' . $file))
		{
			echo 'Almost';
			exit;
		}

		$file_content = file_get_contents(APPPATH . '../' . $file);

		force_download($file_exploded[1], $file_content);
		exit;
	}
}
