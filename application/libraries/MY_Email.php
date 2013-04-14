<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email extends CI_Email {
 
 public function set_custom_header($header_name='', $header_value = '')
 {
  if($header_name=='') {
   return FALSE;
  }

  $this->_set_header($header_name, $header_value);

  return $this;
 }

}