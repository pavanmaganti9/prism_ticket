<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth{
	
	function Auth(){
		$this->ci =& get_instance();
	}
	
	function token(){
		$token = md5(uniqid(rand(),true));
		$this->ci->session->set_userdata('token',$token);
		return $token;
	}
	
}
 