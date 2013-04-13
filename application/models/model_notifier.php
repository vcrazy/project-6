<?php

class Model_notifier extends MY_Model
{
	public function notify($user_id, $messages = array())
	{return;
		$this->db->select('student_send_email, student_send_sms, student_email, student_phone');
		$this->db->from('students');
		$this->db->where('student_id', $user_id);
		$this->db->limit(1);
		$query = $this->db->get();

		$data = $this->single_result($query);

		if(!$data)
		{
			return FALSE;
		}

		if($data['student_send_email'])
		{
			$this->_send($data['student_email'], $messages['email']['topic'], $messages['email']['text']);
		}

		if($data['student_send_sms'])
		{
			$data['student_phone'] .= '@sms.mtel.net';

			$this->_send($data['student_phone'], mb_encode_mimeheader($messages['sms']['title'], "UTF-7", "B"), $messages['sms']['text'], $messages['sms']['from']);
		}

		return TRUE;
	}

	private function _send($email, $topic, $text, $headers = FALSE)
	{
		$this->load->helper('email');
		$this->load->library('email');

		if(!$email || !$text || !valid_email($email))
		{
			return FALSE;
		}

		if($headers)
		{
			$this->email->set_custom_header('From', $headers);
			$this->email->set_custom_header('MIME-Version', '1.0');
			$this->email->set_custom_header('Content-type', 'text/plain');
		}

		if(!PRODUCTION)
		{
			$config = array('protocol' => 'smtp', 'wordwrap' => FALSE, 'smtp_host' => 'localhost', 'smtp_user' => 'root', 'smtp_pass' => '');
		}
		else
		{
			$config = array('wordwrap' => FALSE);
		}

		$this->email->initialize($config);
		$this->email->from('mailer@project-6.loc', 'Project 6');
        $this->email->subject($topic);
		$this->email->message($text);

		$this->email->to($email); 
		$this->email->send();

		return TRUE;
	}
}
