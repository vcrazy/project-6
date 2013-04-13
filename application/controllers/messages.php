<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MY_Controller
{
        protected $data;
        
        public function index() {
            $this->data['menu'] = "menu/menu";
            $this->data['view'] = 'home_page/home_page_view';
        }
        
	public function send()
	{
            $my_groups=array();
            $this->load->model('Model_groups');
            $my_groups=$this->Model_groups->get_my_all();
            $json=array();
//            var_dump($my_groups);
            $groups_ids=array();
            $specialties_ids=array();
            
            foreach ($my_groups as $group) {
                if ( isset($group['group_id']) ) {
                    $groups_ids[]=$group['group_id'];
                    $json_['label']='@'.$group['group_subject'];
                    $json_['value']=$group['group_id'];
                    $json[]=$json_;
                }
                else if (isset($group['specialty_id'])){
                    $specialties_ids[]=$group['specialty_id'];
                    $json_['label']='@'.$group['specialty_name'];
                    $json_['value']=$group['specialty_id'];
                    $json[]=$json_;
                }
            }

            $this->load->model('Model_user');
            $groups_people=$this->Model_user->load_users($groups_ids,$specialties_ids);
            if (!empty ($groups_people)){
                $groups_people = array_map("json_encode" ,$groups_people);
                $groups_people = array_unique($groups_people);
                $groups_people = array_map(function($e){
                    return json_decode($e, TRUE);
                }, $groups_people);
            }
            
            foreach ($groups_people as $group_person) {
                $json_=array();
                $json_['label']=$group_person['student_names'];
                $json_['value']=$group_person['student_id'];
                $json[]=$json_;
            }
            $this->data['users_to_send']=json_encode($json);
            
            $this->data['menu'] = "menu/menu";
            $this->data['view'] = 'messages/send_message';
            
            if (!empty($_POST)) {
                $this->load->helper(array('url'));
                $this->load->library('form_validation');
                $this->form_validation->set_rules('inputPerson', 'To', 'required');
		$this->form_validation->set_rules('InputMessage', 'Message', 'required');

		if ($this->form_validation->run() == FALSE){
                    
		}
		else {
                    $this->load->model("Model_validate");
                    $this->load->model("Model_messages");
                    
                    $data['date']=date("Y-M-D H:i:s");
                    
                    $data['person_from']=1;
                    $data['is_group']=0;
                            
                    if ( !($this->Model_validate->validate_student($_POST['inputPerson'])) ) {
                        $data['person_to']=$_POST['inputPerson'];
                    }
                    
                    $data['person_to']=$_POST['inputPerson'];
                    $data['message']=$_POST['InputMessage'];
                    
                    $this->Model_messages->send($data);
		}
            }
                
            $this->load_view();
	}
}
