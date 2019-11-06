<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth{
	
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('email');
	}  
	
	function Auth(){
		$this->ci =& get_instance();
	}
	
	function token(){
		$token = md5(uniqid(rand(),true));
		$this->ci->session->set_userdata('token',$token);
		return $token;
	}
	
	public function email_func($to, $subject, $body){
		$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'pavanmaganti87@gmail.com',
					'smtp_pass' => 'Pavan@14357',
					'mailtype'  => 'html', 
					'charset'   => 'iso-8859-1'
				);
		$this->ci->load->library('email', $config);
		$this->ci->email->set_newline("\r\n");

		$result = $this->ci->email->send();

				
		$this->ci->email->initialize($config);

		$this->ci->email->from('mds@gmail.com', 'Manidweepam');
		$this->ci->email->to($to); 

		$this->ci->email->subject($subject);
		$this->ci->email->message($body);  

		$this->ci->email->send();
	}
	
}
 