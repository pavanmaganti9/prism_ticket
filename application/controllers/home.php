<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct() { 
        parent::__construct(); 
         
        // Load form validation ibrary & user model 
        $this->load->library('form_validation'); 
        $this->load->model('Admins'); 
         $this->load->model('User_model');
        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    } 

	public function index()
	{
		$this->load->view('home');
	}
	
	public function register()
	{
		$data = $userData = array(); 
         
        // If registration request is submitted 
        if($this->input->post('signupSubmit')){ 
            $this->form_validation->set_rules('first_name', 'First Name', 'required'); 
            $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check'); 
            $this->form_validation->set_rules('password', 'Password', 'required'); 
			$this->form_validation->set_rules('phone', 'Phone', 'required'); 
            $this->form_validation->set_rules('conf_password', 'Confirm password', 'required|matches[password]'); 
 
            $userData = array( 
                'first_name' => strip_tags($this->input->post('first_name')), 
                'last_name' => strip_tags($this->input->post('last_name')), 
                'email' => strip_tags($this->input->post('email')), 
                'password' => md5($this->input->post('password')), 
                'gender' => $this->input->post('gender'), 
                'phone' => strip_tags($this->input->post('phone')),
				'user_type' => 'user'				
            ); 
 
            if($this->form_validation->run() == true){ 
                $insert = $this->Admins->insert($userData); 
                if($insert){ 
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('register'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
         
        // Posted data 
        $data['user'] = $userData; 
         
        // Load view 
        /* $this->load->view('elements/header', $data); 
        $this->load->view('users/registration', $data); 
        $this->load->view('elements/footer'); */
		$this->load->view('register');
	}
	
	// Existing email check during validation 
    public function email_check($str){ 
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'email' => $str 
            ) 
        ); 
        $checkEmail = $this->Admins->getRows($con); 
        if($checkEmail > 0){ 
            $this->form_validation->set_message('email_check', 'The given email already exists.'); 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    }
	
	public function posts(){
		$data['posts'] = $this->Admins->getallposts(); 
		$this->load->view('posts',$data);
	}
	
	public function addpost(){
		
		if($this->input->post('postSubmit')){ 
            $this->form_validation->set_rules('title', 'Title', 'required'); 
            $this->form_validation->set_rules('desc', 'Description', 'required'); 
			
			$userData = array( 
                'title' => strip_tags($this->input->post('title')), 
                'desc' => strip_tags($this->input->post('desc'))			
            ); 
 
            if($this->form_validation->run() == true){ 
				$insert = $this->Admins->insertpost($userData); 
                if($insert){ 
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('posts'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
			
		}
		
		$this->load->view('addpost');
	}
	
	public function editpost($id){
        $data = array();
        
        //get post data
        $postData = $this->Admins->getallposts($id);
        
        //if update request is submitted
        if($this->input->post('postSubmit')){
            //form field validation rules
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('desc', 'Description', 'required');
            
            //prepare cms page data
            $postData = array(
                'title' => $this->input->post('title'),
                'desc' => $this->input->post('desc')
            );
            
            //validate submitted form data
            if($this->form_validation->run() == true){
                //update post data
                $update = $this->post->updatepost($postData, $id);

                if($update){
                    $this->session->set_userdata('success_msg', 'Post has been updated successfully.');
                    redirect('posts');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }

        
        $data['post'] = $postData;
        $data['title'] = 'Update Post';
        $data['action'] = 'Edit';
        
        //load the edit page view
        $this->load->view('editpost', $data);
    }
	
	public function deletepost($id){
        //check whether post id is not empty
        if($id){
            //delete post
            $delete = $this->Admins->delete($id);
            
            if($delete){
                $this->session->set_userdata('success_msg', 'Post has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }

        redirect('posts');
    }
	
	public function login(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        $this->form_validation->set_rules('password', 'password', 'required'); 
		
		if($this->form_validation->run() == FALSE){
			
			$this->load->view('login');
			
		}else{
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean(md5($this->input->post('password')));
			
			$user = $this->User_model->login($email,$password);
			if($user){
				$userdata = array(
					'id' => $user->id,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'email' => $user->email,
					'authenticated' => TRUE
				);
				
				$this->session->set_userdata($userdata);
				redirect('home');
			}else{
				$this->session->set_flashdata('message', 'Invalid email or password');
				redirect('login');
			}
		}
             
		/* $data = array(); 
         
        // Get messages from the session 
        if($this->session->userdata('success_msg')){ 
            $data['success_msg'] = $this->session->userdata('success_msg'); 
            $this->session->unset_userdata('success_msg'); 
        } 
        if($this->session->userdata('error_msg')){ 
            $data['error_msg'] = $this->session->userdata('error_msg'); 
            $this->session->unset_userdata('error_msg'); 
        } 
         
        // If login request submitted 
        if($this->input->post('loginSubmit')){ 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
             
            if($this->form_validation->run() == true){ 
                $con = array( 
                    'returnType' => 'single', 
                    'conditions' => array( 
                        'email'=> $this->input->post('email'), 
                        'password' => md5($this->input->post('password')), 
                        'status' => 1 
                    ) 
                ); 
                $checkLogin = $this->Admins->getRows($con); 
                if($checkLogin){ 
                    $this->session->set_userdata('isUserLoggedIn', TRUE); 
                    $this->session->set_userdata('userId', $checkLogin['id']); 
					//$this->load->view('admin/dashboard', $data);
                    redirect('home'); 
                }else{ 
                    $data['error_msg'] = 'Wrong email or password, please try again.'; 
					
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
         $this->load->view('login', $data); */
	}
	
	/* public function home(){ 
        $data = array(); 
        if($this->isUserLoggedIn){ 
            $con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->Admins->getRows($con); 
			//print_r($data);die();
            $data['title'] = 'Dashboard';
            // Pass the user data and load view 
            //$this->load->view('admin/header', $data); 
            $this->load->view('home', $data); 
            //$this->load->view('admin/footer'); 
        }else{ 
            redirect('home'); 
        } 
    } */
	
	public function logout(){ 
        $this->session->unset_userdata('userdata'); 
        //$this->session->unset_userdata('email'); 
        $this->session->sess_destroy(); 
        redirect('home'); 
    } 
	
}
