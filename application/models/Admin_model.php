<?php
defined('BASEPATH') OR exit('No direct access allowed');

class Admin_model extends CI_MODEL{
	
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
	
	function getuser($id){
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
    }
	
}

?>