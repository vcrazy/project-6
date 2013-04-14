<?php

class Model_notifier extends MY_Model
{
	public function notify($user_id, $messages = array())
	{
//		$this->db->select('student_send_email, student_send_sms, student_email, student_phone');
		
	}

	private function _send($name, $email, $topic, $text)
	{
		$this->load->helper('email');
		$this->load->library('email');

		if(!$name || !$email || !$text || !valid_email($email))
		{
			return FALSE;
		}

		$this->db->from('mails');
		$this->db->select('email');
		$query = $this->db->get();
		
		$emails = $this->to_array_single($query, 'email');

		if(!PRODUCTION)
		{
			$config = array('protocol' => 'smtp', 'wordwrap' => FALSE, 'smtp_host' => 'localhost', 'smtp_user' => 'root', 'smtp_pass' => '');
		}
		else
		{
			$config = array('wordwrap' => FALSE);
		}
		$this->email->initialize($config);
		$this->email->from('mailer@mg-security.com', 'MG Security');
        $this->email->subject('Съобщение от формата за контакт във Вашия сайт');
		$this->email->message("Съобщение от формата за контакт във Вашия сайт mg-security.com:\n\nОт: $name, $email\n\nТема: $topic\n\nСъобщение:\n$text");

		foreach($emails as $email)
		{
			$this->email->to($email); 
			$this->email->send();
		}

		return TRUE;
	}
}
