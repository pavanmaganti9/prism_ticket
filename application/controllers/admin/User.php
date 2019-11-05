<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load form validation ibrary & user model 
        //$this->load->library('form_validation'); 
        $this->load->model('Admin_model'); 
         $this->load->model('User_model'); 
        // User login status 
        //$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    }

	public function login(){
	
			
	$data['title'] = 'Login';
	//$this->load->view('admin/login',$data);
	
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
    $this->form_validation->set_rules('password', 'password', 'required'); 
	if($this->form_validation->run() == FALSE){
			$data['token'] = $this->auth->token();
			$this->load->view('admin/login',$data);
			
		}else{
			if($this->input->post('prismadmintoken') == $this->session->userdata('token')){
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean(md5($this->input->post('password')));
			$user = $this->Admin_model->login($email,$password);
			
			if(!empty($user)){
				$userdata = array(
					'id' => $user->id,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'email' => $user->email,
					'type' => $user->user_type,
					'company' => $user->company,
					'authenticated' => TRUE
				);
				
				$this->session->set_userdata($userdata);
				redirect('admin/dashboard');
			}else{
				$this->session->set_flashdata('message', 'Invalid email or password');
				redirect('admin');
			}
			}else{
				redirect('admin');
			}
			$this->load->view('admin/login',$data);
		}
	
	}
	
	public function dashboard(){ 
        $data = array(); 
        if($this->session->userdata('email')){ 
            $data['title'] = 'Dashboard';
             
            $this->load->view('admin/dashboard', $data); 
        }else{ 
            redirect('admin'); 
        } 
    }
	
	public function projects(){ 
        $data = array(); 
        if($this->session->userdata('email')){  
			$id = $this->session->userdata('id');
			$data['title'] = 'Projects';
            $data['user'] = $this->Admin_model->getallprojects(); 
            $data['sess'] = $this->Admin_model->getuser($id,$this->session->userdata('company'));
            $this->load->view('admin/projects', $data);  
        }else{ 
            redirect('admin'); 
        } 
    }
	
	public function addproject(){ 
        $data = array(); 
        if($this->session->userdata('email')){ 
			//$id = $this->session->userdata('id');
			$data['title'] = 'Add Project';
			
			if($this->input->post('projectSubmit')){ 
			$this->form_validation->set_rules('title', 'Title', 'required|xss_clean|is_unique[projects.title]'); 
            $this->form_validation->set_rules('desc', 'Description', 'required|xss_clean'); 
			$projectData = array( 
                'title' => strip_tags($this->security->xss_clean($this->input->post('title'))), 
                'desc' => strip_tags($this->security->xss_clean($this->input->post('desc')))				
            );

			if($this->form_validation->run() == FALSE){
				
				$this->load->view('admin/addproject', $data);
				
			}else{
				$insert = $this->Admin_model->insertproject($projectData);
				if($insert){
				$this->session->set_flashdata('message', 'Project added successfully');					
                    //$this->session->set_flashdata('message', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('admin/addproject'); 
                }else{ 
                    $this->session->set_flashdata('message', 'Invalid email or password');
                }
			}			
		}else{
		$this->load->view('admin/addproject', $data);
		}
		}else{ 
            redirect('admin'); 
        } 
		
	}
	
	public function editproject($id){
        $data = array();
        
        //get post data
        $postData = $this->Admin_model->getallprojects($id);
        
        //if update request is submitted
        if($this->input->post('projectSubmit')){
            //form field validation rules
			$this->form_validation->set_rules('title', 'Title', 'required|xss_clean'); 
            $this->form_validation->set_rules('desc', 'Description', 'required|xss_clean'); 
            
            //prepare cms page data
			$postData = array( 
                'title' => strip_tags($this->security->xss_clean($this->input->post('title'))), 
                'desc' => strip_tags($this->security->xss_clean($this->input->post('desc')))				
            );
			
			if($this->form_validation->run() == FALSE){
				
				//$this->load->view('admin/editproject/'.$id, $data);
				
			}else{
				$update = $this->Admin_model->updateproject($postData, $id);
				if($update){
                    $this->session->set_flashdata('message', 'Project has been updated successfully.');
                    redirect('admin/editproject/'.$id);
                }else{
					$this->session->set_flashdata('message', 'Project has been updated successfully.');
                    //$data['error_msg'] = 'Some problems occurred, please try again.';
                }
			}
                        
        }

        
        $data['post'] = $postData;
        $data['title'] = 'Update Project';
        $data['action'] = 'Edit';
        
        //load the edit page view
        $this->load->view('admin/editproject', $data);
    }
	
	public function deleteproject($id){
        //check whether post id is not empty
        if($id){
            //delete post
            $delete = $this->Admin_model->deleteproject($id);
            
            if($delete){
                $this->session->set_userdata('success_msg', 'Project has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }

        redirect('admin/projects');
    }
	
	public function companies(){ 
        $data = array(); 
        if($this->session->userdata('email')){  
			$id = $this->session->userdata('id');
			$data['title'] = 'Company';
            $data['user'] = $this->Admin_model->getallcompanies(); 
            $data['sess'] = $this->Admin_model->getuser($this->session->userdata('id'),$this->session->userdata('company'));
            $this->load->view('admin/companies', $data);  
        }else{ 
            redirect('admin'); 
        } 
    }
	
	public function addcompany(){ 
        $data = array(); 
        if($this->session->userdata('email') && $this->session->userdata('type') == 'superadmin'){
			
			//$id = $this->session->userdata('id');
			$data['title'] = 'Add Project';
			
			if($this->input->post('companySubmit')){ 
			$this->form_validation->set_rules('title', 'Name', 'required|xss_clean|is_unique[company.title]');
            $this->form_validation->set_rules('desc', 'Description', 'required|xss_clean'); 
			if (empty($_FILES['clogo']['name']))
			{
				$this->form_validation->set_rules('clogo', 'Logo', 'required');
			}
			

			if($this->form_validation->run() == FALSE){
				
				$this->load->view('admin/addcompany', $data);
				
			}else{
				$image = time().'_'.$_FILES["clogo"]['name'];
				
				//$config = array(
				$config['upload_path'] = './assets/companylogo/';
                $config['allowed_types']        = 'gif|jpg|png|pdf|doc';
                $config['max_size']             = 100000;
                $config['max_width']            = 100000;
                $config['max_height']           = 100000;
				$config['file_name'] = $image;
				//);
				$this->load->library('upload', $config); 
				
				if($this->upload->do_upload('clogo'))
				{
					//$res['msg']="Image has been uploaded!";
					//$this->load->view('image', $res);
				}
				else
				{
					
					//$this->load->view('image');
				}
				
				$companyData = array( 
                'title' => strip_tags($this->security->xss_clean($this->input->post('title'))), 
                'desc' => strip_tags($this->security->xss_clean($this->input->post('desc'))),
				'logo' => strip_tags($this->security->xss_clean($image))				
            );
				$insert = $this->Admin_model->insertcompany($companyData);
				if($insert){
					
				$this->session->set_flashdata('message', 'Company added successfully');					
                    //$this->session->set_flashdata('message', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('admin/addcompany'); 
                }else{ 
                    $this->session->set_flashdata('message', 'Invalid email or password');
                }
			}			
		}else{
		$this->load->view('admin/addcompany', $data);
		}
		}else{ 
            redirect('admin/dashboard'); 
        } 
		
	}
	
	public function deletecompany($id){
        //check whether post id is not empty
        if($id){
            //delete post
            $delete = $this->Admin_model->deletecompany($id);
            
            if($delete){
                $this->session->set_userdata('success_msg', 'Project has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }

        redirect('admin/company');
    }
	
	public function getusers(){ 
        $data = array(); 
        if($this->session->userdata('email')){ 
            /* $con = array( 
                'id' => $this->session->userdata('userId') 
            ); */ 
			$id = $this->session->userdata('id');
			$data['title'] = 'Get Users';
            $data['user'] = $this->Admin_model->getallusersbycompany($this->session->userdata('company'),$this->session->userdata('type')); 
			$data['sess'] = $this->Admin_model->getuser($id,$this->session->userdata('company'));
            $this->load->view('admin/tables', $data); 
            //$this->load->view('admin/footer'); 
        }else{ 
           // redirect('admin/login'); 
        } 
    }
	
	public function adduser(){ 
        $data = array(); 
        if($this->session->userdata('email')){ 
			if($this->session->userdata('type') == 'admin'){ 
			$id = $this->session->userdata('userId');
			$data['title'] = 'Add Users';
            //$data = $userData = array(); 
         	 
        // If registration request is submitted 
        if($this->input->post('signupSubmit')){ 
            $this->form_validation->set_rules('first_name', 'First Name', 'required'); 
            $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]'); 
            $this->form_validation->set_rules('password', 'Password', 'required'); 
			$this->form_validation->set_rules('phone', 'Phone', 'required'); 
            $this->form_validation->set_rules('conf_password', 'Confirm password', 'required|matches[password]'); 
			
			$fname = $this->security->xss_clean($this->input->post('first_name'));
			$lname = $this->security->xss_clean($this->input->post('last_name'));
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean($this->input->post('password'));
			$gender = $this->security->xss_clean($this->input->post('gender'));
			$phone = $this->security->xss_clean($this->input->post('phone'));
			$company = $this->security->xss_clean($this->session->userdata('company'));
			
		$userData = array( 
				'first_name' => $fname, 
                'last_name' => $lname, 
                'email' => $email, 
                'password' => md5($password), 
                'gender' => $gender, 
                'phone' => $phone,
				'user_type' => 'user',
				'company' => $company
            ); 
 
            if($this->form_validation->run() == true){ 
                $insert = $this->Admin_model->insertuser($userData); 
				
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'pavanmaganti87@gmail.com',
					'smtp_pass' => 'Pavan@14357',
					'mailtype'  => 'html', 
					'charset'   => 'iso-8859-1'
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");

				// Set to, from, message, etc.

				$result = $this->email->send();

				
				$this->email->initialize($config);

				$this->email->from('mds@gmail.com', 'Manidweepam');
				$this->email->to($this->input->post('email')); 

				$this->email->subject($company.' User Registration');
				$this->email->message('Hi '.$fname.' '.$lname.',<br><br>Congrats for joining with '.$company.'<br><br>Your username : '.$email.' and  password : '.$password.'<br><br>Company name is '.$company.'<br><br>Click here to <a href="">Start</a><br>Thanks,<br>Prism.');  

				$this->email->send();

				
                if($insert){ 
                    $this->session->set_flashdata('message', 'User has been added successfully.'); 
                    redirect('admin/adduser'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{ 
                //$data['error_msg'] = 'Please fill all the mandatory fields.'; 
            }
		}			
            // Pass the user data and load view 
            //$this->load->view('admin/header', $data); 
			//$data['company'] = $this->Admin_model->getallcompanies();
            $this->load->view('admin/adduser', $data); 
            //$this->load->view('admin/footer'); 
			}else{
				redirect('admin/dashboard');
			}
        }else{ 
            redirect('admin'); 
        }
    }
	
	public function edituser($id){
        $data = array();
        
        $company = $this->session->userdata('company');
        $postData = $this->Admin_model->getuser($id,$company);
        //print_r($postData);die();
        //if update request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			//$this->form_validation->set_rules('password', 'Password', 'required');
			//$this->form_validation->set_rules('conf_password', 'Confirm password', 'required|matches[password]');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('role', 'UserRole', 'required');
			
            
            //prepare cms page data
            $postData = array(
                'first_name' => $this->security->xss_clean($this->input->post('first_name')),
				'last_name' => $this->security->xss_clean($this->input->post('last_name')),
				//'password' => $this->security->xss_clean($this->input->post('password')),
				'phone' => $this->security->xss_clean($this->input->post('phone')),
				'user_type' => $this->security->xss_clean($this->input->post('role')),
				'company' => $this->security->xss_clean($this->input->post('company'))
            );
            
			if($this->form_validation->run() == FALSE){
				
				//$this->load->view('admin/editproject/'.$id, $data);
			}else{
				$update = $this->Admin_model->updateuser($postData, $id);
				if($update){
                    $this->session->set_flashdata('message', 'User has been updated successfully.');
                    redirect('admin/edituser/'.$id);
                }else{
					$this->session->set_flashdata('message', 'User has been updated successfully.');
                    //$data['error_msg'] = 'Some problems occurred, please try again.';
                }
			}
			
        }
        $data['user'] = $this->Admin_model->getallcompanies(); 
        $data['post'] = $postData;
        $data['title'] = 'Update User';
        $data['action'] = 'Edit';
        $data['docs'] = $this->Admin_model->getdocs($id);
		
        //load the edit page view
        $this->load->view('admin/edituser', $data);
    }
	
	public function editcompany($id){
        $data = array();
        
        //get post data
        $postData = $this->Admin_model->getallcompanies($id);
        
        //if update request is submitted
        if($this->input->post('projectSubmit')){
            //form field validation rules
			$this->form_validation->set_rules('title', 'Title', 'required|xss_clean'); 
            $this->form_validation->set_rules('desc', 'Description', 'required|xss_clean'); 
            
            //prepare cms page data
			$postData = array( 
                'title' => strip_tags($this->security->xss_clean($this->input->post('title'))), 
                'desc' => strip_tags($this->security->xss_clean($this->input->post('desc')))				
            );
			
			if($this->form_validation->run() == FALSE){
				
				//$this->load->view('admin/editproject/'.$id, $data);
				
			}else{
				$update = $this->Admin_model->updatecompany($postData, $id);
				if($update){
                    $this->session->set_flashdata('message', 'Company has been updated successfully.');
                    redirect('admin/editcompany/'.$id);
                }else{
					$this->session->set_flashdata('message', 'Project has been updated successfully.');
                    //$data['error_msg'] = 'Some problems occurred, please try again.';
                }
			}
                        
        }

        
        $data['post'] = $postData;
        $data['title'] = 'Edit Company';
        $data['action'] = 'Edit';
        
        //load the edit page view
        $this->load->view('admin/editcompany', $data);
    }
	
	public function userprofile(){
		$data['title'] = 'User Profile';
		if($this->session->userdata('email')){
		$id = $this->session->userdata('id');
			if($this->input->post('profileSubmit')){
				//form field validation rules
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('conf_password', 'Confirm password', 'required|matches[password]');
							
				//prepare cms page data
				$postData = array(
					'password' => $this->security->xss_clean(md5($this->input->post('password'))),
					);
				
				if($this->form_validation->run() == FALSE){
					
					//$this->load->view('admin/editproject/'.$id, $data);
				}else{
					$update = $this->Admin_model->updateuser($postData, $id);
					if($update){
						$this->session->set_flashdata('message', 'Password Updated successfully.');
						//$this->load->view('admin/userprofile', $data);
					}else{
						$this->session->set_flashdata('message', 'User has been updated successfully.');
						//$data['error_msg'] = 'Some problems occurred, please try again.';
					}
				}
			}
			$this->load->view('admin/userprofile', $data);
		}else{
			redirect('admin/dashboard');
		}
	}

	public function logout(){ 
        $this->session->unset_userdata('userdata'); 
        $this->session->sess_destroy(); 
        redirect('admin'); 
    } 
	
}