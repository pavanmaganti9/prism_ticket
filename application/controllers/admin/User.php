<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load form validation ibrary & user model 
        //$this->load->library('form_validation'); 
        $this->load->model('Admin_model'); 
         
        // User login status 
        //$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    }

	public function login(){ 
	$data['title'] = 'Login';
	
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
    $this->form_validation->set_rules('password', 'password', 'required'); 
	if($this->form_validation->run() == FALSE){
			
			$this->load->view('admin/login',$data);
			
		}else{
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean(md5($this->input->post('password')));
			$user = $this->Admin_model->login($email,$password);
			if($user){
				$userdata = array(
					'id' => $user->id,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'email' => $user->email,
					'authenticated' => TRUE
				);
				
				$this->session->set_userdata($userdata);
				redirect('admin/dashboard');
			}else{
				$this->session->set_flashdata('message', 'Invalid email or password');
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
            $data['sess'] = $this->Admin_model->getuser($id);
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
            $data['sess'] = $this->Admin_model->getuser($this->session->userdata('id'));
            $this->load->view('admin/companies', $data);  
        }else{ 
            redirect('admin'); 
        } 
    }
	
	public function addcompany(){ 
        $data = array(); 
        if($this->session->userdata('email')){ 
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
            redirect('admin'); 
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
	
	public function adduser(){ 
        $data = array(); 
        if($this->session->userdata('email')){ 
			$id = $this->session->userdata('userId');
			$data['title'] = 'Add Users';
            //$data = $userData = array(); 
         
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

				$this->email->from('mds@gmail.com', 'MDS');
				$this->email->to($this->input->post('email')); 

				$this->email->subject('User Registration');
				$this->email->message('Testing the email class.');  

				$this->email->send();

				
                if($insert){ 
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
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
            $this->load->view('admin/adduser', $data); 
            //$this->load->view('admin/footer'); 
        }else{ 
            redirect('admin'); 
        }
    }

	public function logout(){ 
        $this->session->unset_userdata('userdata'); 
        $this->session->sess_destroy(); 
        redirect('admin'); 
    } 
	
}