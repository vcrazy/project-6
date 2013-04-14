<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MY_Controller
{
        protected $data;
        
        public function index() {
            $this->data['menu'] = "menu/menu";
            $this->data['view'] = 'home_page/home_page_view';
        }
        
        public function sent() {
            $this->data['menu'] = "menu/menu";
            $this->data['view'] = 'messages/sent_messages';
            $this->load->model('Model_messages');
            $this->data['all_sent_messages']=$this->Model_messages->get_sent_messages();
            $this->load_view();
        }
        
	public function send() {
            $my_groups=array();
            $this->load->model('Model_groups');
            $my_groups=$this->Model_groups->get_my_all();
            $json=array();
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
                $this->form_validation->set_rules('send_to_id', 'Message', 'required');

		if ($this->form_validation->run() == FALSE) {
                    
		}
		else {
                    $session=$this->session->userdata('user');
                    $this->load->model("Model_validate");
                    $this->load->model("Model_messages");
                    $data=array();
                    $data['date']=date("Y-m-d H:i:s");
                    $data['person_from']=$session['student_id'];
                    $data['message']=$_POST['InputMessage'];
                    $data['person_to']=0;
                    
                    $data['is_group']=0;
                    if ( isset($_POST['is_it_group']) ) {
                        if ($_POST['is_it_group']==1 ) {
                            $data['is_group']=$_POST['send_to_id'];
                        }
                    }
                    
                    $data['is_speciality']=0;
                    if ( $data['is_group']>0 ) {
                        $user_speciality=$this->Model_user->get_speciality_by_id();
                        var_dump( $user_speciality);
                        var_dump( $_POST['inputPerson']);
                        $specialty_subject= ltrim ($_POST['inputPerson'],'@');
                        if ( strcmp($user_speciality,$specialty_subject)==0) {
                            $data['is_group']=0;
                            $data['is_speciality']=$_POST['send_to_id'];
                        }
                    } else {
                        if ( $this->Model_validate->validate_student($_POST['send_to_id']) ) {
                            $data['person_to']=$_POST['send_to_id'];
                        }
                    }

                    if(!empty($_FILES))
                    {
                        $this->load->helper('form');

                        $config['upload_path'] = APPPATH . '../uploads/';
                        $config['max_size']	= '2048';
                        $config['allowed_types'] = '*';
                        $config['encrypt_name'] = TRUE; // rename

                        $this->load->library('upload', $config);

                        $this->upload->do_upload();
                        $errors = $this->upload->display_errors();
                        if(empty($errors))
                        {
                                $file_data = $this->upload->data();
                                $data['file_path'] = 'uploads/' . $file_data['file_name'];
                        }
                    }
                    
                    $result = $this->Model_messages->send($data);

					if($result && $data['person_to'])
					{
						$this->data['sent_message'] = TRUE;
						$this->data['sent_to_user_id'] = $data['person_to'];
						$this->data['sent_message_text'] = $_POST['InputMessage'];
						$user = $this->session->userdata('user');
						$this->data['sent_from_names'] = $user['student_names'];

						$this->load->model('Model_notifier');
						$this->Model_notifier->notify(
							$data['person_to'], array(
								'email' => array(
									'text' => 'Здравейте. Имате ново съобщение в Project 6.',
									'topic' => 'Ново съобщение в Project 6'
								),
								'sms' => array(
									'text' => 'Zdraveite. Imate novo syobshtenie v Project 6.',
									'title' => 'Novo syobshtenie v Project 6',
									'from' => 'Project 6'
								)
							)
						);
					}
		}
            }
            $this->load_view();
	}
}
