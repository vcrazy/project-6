<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Specialties extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_specialties');
		$this->load->model('Model_messages');
	}

	public function specialty($sp_id)
	{
                $this->data['menu'] = "menu/menu";
                $message=array();
		if($sp_id)
		{
			$this->data['content_title'] = 'Специалности';
                        $this->data['view'] = 'specialty/specialty_messages';
                        $specialty = $this->Model_specialties->get($sp_id);
                        $messages = $this->Model_messages->get_specialty_messages($sp_id);
		}
		else
		{
			$this->data['content_title'] = 'Администрация';
                        $this->data['view'] = 'specialty/specialty_administration_messages';
                        
                        $specialty['specialty_name']='Администрация';
                        $messages = $this->Model_messages->get_specialty_adm_messages($sp_id);
		}
                
                $this->data['all_messages_from_specialty']=$messages;
                $this->data['all_specialties']=$specialty;
//		var_dump($messages);

		$this->load_view();
	}
}
