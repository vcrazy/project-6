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
            $this->data['menu'] = "menu/menu";
            $this->data['view'] = 'messages/send_message';
            
            if (!empty($_POST))
            {
              $this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('inputPerson', 'To', 'required');
		$this->form_validation->set_rules('InputMessage', 'Message', 'required');

		if ($this->form_validation->run() == FALSE)
		{
                     var_dump("ne");
		}
		else
		{
                    $this->load->model("Model_validate");
                    $this->load->model("Model_messages");                    

                    $data=array();
                    $data['date']=$date=date("Y-M-D H:i:s");
                    
                    $data['person_from']=1;
                    $data['is_group']=0;
                            
                    if ( !($this->Model_validate->validate_student($_POST['inputPerson']) ) ) {
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
