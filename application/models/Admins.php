<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Admins extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table = 'users'; 
    } 
     
    /* 
     * Fetch user data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array()){ 
        $this->db->select('*'); 
        $this->db->from($this->table); 
         
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        } 
         
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
                if(!empty($params['id'])){ 
                    $this->db->where('id', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
                $this->db->order_by('id', 'desc'); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                 
                $query = $this->db->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        } 
         
        // Return fetched data 
        return $result; 
    } 
     
    /* 
     * Insert user data into the database 
     * @param $data data to be inserted 
     */ 
    public function insert($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("created", $data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists("modified", $data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
             
            // Insert member data 
            $insert = $this->db->insert($this->table, $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
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
			//return $query->result();
            //$query = $this->db->get('users');
			//$query = $this->db->order_by('created', 'DESC');
            return $query->result_array();
        }
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
	
	function getuser($id){
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
    }
	
	function getallposts($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('posts', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('posts');
            return $query->result_array();
        }
    }

	function getallpostsq(){
        
            $query = $this->db->get('posts');
            return $query->result_array();
        
    }
	/*
     * Insert post
     */
    public function insertpost($data = array()) {
        
        if(!empty($data)){
			$insert = $this->db->insert('posts', $data);
            return $insert;
        }else{
            return false;
        }
    }
    
    /*
     * Update post
     */
    public function updatepost($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('posts', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }
    
    /*
     * Delete post
     */
    public function delete($id){
        $delete = $this->db->delete('posts',array('id'=>$id));
        return $delete;
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
	
	function getprojectRow($params = array()){ 
        $this->db->select('*'); 
        $this->db->from('projects'); 
          
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }
         
        // Return fetched data 
        return $result; 
    }
	
	
}