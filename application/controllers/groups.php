<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_groups');
		$this->load->model('Model_messages');
	}

	public function group($group_id)
	{
                $session=$this->session->userdata('user');
                $iam=$session['student_id'];
		$this->data['content_title'] = 'Групи';
                
                $this->data['menu'] = "menu/menu";
                $this->data['view'] = 'groups/group_messages';

		$group = $this->Model_groups->get($group_id);
		$messages = $this->Model_messages->get_group_messages($group_id);
                $this->data['all_messages_from_group']=$messages;
                $this->data['all_groups']=$group;
                $this->data['i_am']=$iam;
		$this->load_view();
                
	}
}
