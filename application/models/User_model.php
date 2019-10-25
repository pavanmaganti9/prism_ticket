<?php
defined('BASEPATH') OR exit('No direct access allowed');

class User_model extends CI_MODEL{
	
	public function login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		$query = $this->db->get('users');
		//print_r($query);
		if($query->num_rows() == 1){
			return $query->row();
		}
		return false;
	}
	
}

?>