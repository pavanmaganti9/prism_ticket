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
	
	public function insertuploads($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("created", $data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            }   
            // Insert project data 
            $insert = $this->db->insert('userfileuploads', $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }
	
	function getdocs($id,$email){
		
            $query = $this->db->get_where('userfileuploads', array('user_id' => $id,'user_email' => $email));
            return $query->result_array();
    }
	
	function getuser($id){
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
    }
	
	function getallcompanies($name = ""){
        if(!empty($name)){
            $query = $this->db->get_where('company', array('title' => $name));
            return $query->row_array();
        }else{
			$this->db->select('*');
			$this->db->order_by("created","desc");
			$this->db->from('company');
			$query=$this->db->get();
            return $query->result_array();
        }
    }
	
	function getuseruid($uid){
            $query = $this->db->get_where('users', array('uid' => $uid));
            return $query->row_array();
    }
	
	public function signup_updateuser($data, $uid) {
		
        if(!empty($data) && !empty($uid)){
            $update = $this->db->update('users', $data, array('uid'=>$uid));
			$str = $this->db->last_query();
			//print_r($str); die();
            return $update;
        }else{
			$update = 'No User';
			return $update;
           // return false;
        }
    }
	
	public function updater($data, $id, $table){
		if(!empty($data) && !empty($id)){
            $update = $this->db->update($table, $data, array('id'=>$id));
			$str = $this->db->last_query();
			//print_r($str); die();
            return $update;
        }else{
			$update = 'No User';
			return $update;
           // return false;
        }
	}
	
}

?>