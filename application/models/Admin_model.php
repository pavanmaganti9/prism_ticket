<?php
defined('BASEPATH') OR exit('No direct access allowed');

class Admin_model extends CI_MODEL{
	
	public function login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		//$this->db->where('user_type', 'admin');
		$type = array('admin', 'superadmin');
		$this->db->where_in('user_type', $type);
		$query = $this->db->get('users');
		
		$sql = $this->db->last_query();
		//print_r($sql); die();
		if($query->num_rows() > 0){
			return $query->row();
		}
		return false;
	}
	
	public function insertproject($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("created", $data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            }   
            // Insert project data 
            $insert = $this->db->insert('projects', $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }
	
	function getallprojects($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('projects', array('id' => $id));
            return $query->row_array();
        }else{
			$this->db->select('*');
			//$this->db->where('tennant_id',$tennant_id);
			$this->db->order_by("created","desc");
			$this->db->from('projects');
			$query=$this->db->get();
			//return $query->result();
            //$query = $this->db->get('users');
			//$query = $this->db->order_by('created', 'DESC');
            return $query->result_array();
        }
    }
	public function updateproject($data, $id) {
		
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('projects', $data, array('id'=>$id));
            return $update;
        }else{
            return false;
        }
    }
	public function deleteproject($id){
        $delete = $this->db->delete('projects',array('id'=>$id));
        return $delete;
    }
	
	public function insertcompany($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("created", $data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            }   
            // Insert project data 
            $insert = $this->db->insert('company', $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }
	function getallcompanies($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('company', array('id' => $id));
            return $query->row_array();
        }else{
			$this->db->select('*');
			$this->db->order_by("created","desc");
			$this->db->from('company');
			$query=$this->db->get();
            return $query->result_array();
        }
    }
	public function updatecompany($data, $id) {
		
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('company', $data, array('id'=>$id));
            return $update;
        }else{
            return false;
        }
    }
	
	public function deletecompany($id){
        $delete = $this->db->delete('company',array('id'=>$id));
        return $delete;
    }
	
	function getallusers($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }else{
			$this->db->select('*');
			//$this->db->where('tennant_id',$tennant_id);
			$this->db->order_by("created","desc");
			$this->db->from('users');
			$query=$this->db->get();
            return $query->result_array();
        }
    }
	
	function getuser($id,$company){
            $query = $this->db->get_where('users', array('id' => $id,'company' => $company));
            return $query->row_array();
    }
	
	public function insertuser($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("created", $data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists("modified", $data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
             
            // Insert member data 
            $insert = $this->db->insert('users', $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }
	public function updateuser($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('users', $data, array('id'=>$id));
            return $update;
			$this->db->last_query();
        }else{
            return false;
        }
    }
	
	function getdocs($id){
		
            $query = $this->db->get_where('userfileuploads', array('user_id' => $id));
            return $query->result_array();
    }
	
	function getusertrumail($email){
            $query = $this->db->get_where('users', array('email' => $email));
            return $query->row_array();
    }
	
	function getallusersbycompany($company,$type){
			if($type == 'admin'){
            $query = $this->db->get_where('users', array('company' => $company));
            return $query->result_array();
			}else{
			$query = $this->db->get('users');
            return $query->result_array();	
			}
        
    }
	
}

?>