<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Admin extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load form validation ibrary & user model 
        $this->load->library('form_validation'); 
        $this->load->model('Admins'); 
         
        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    } 
     
    public function index(){ 
        if($this->isUserLoggedIn){ 
            redirect('admin/account'); 
        }else{ 
            redirect('admin/login'); 
        } 
    } 
 
    public function dashboard(){ 
        $data = array(); 
        if($this->isUserLoggedIn){ 
            $con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->Admins->getRows($con); 
            $data['title'] = 'Dashboard';
             
            $this->load->view('admin/dashboard', $data); 
        }else{ 
            redirect('admin'); 
        } 
    } 
 
	public function tables(){ 
        $data = array(); 
        if($this->isUserLoggedIn){ 
            /* $con = array( 
                'id' => $this->session->userdata('userId') 
            ); */ 
			$id = $this->session->userdata('userId');
			$data['title'] = 'Get Users';
            $data['user'] = $this->Admins->getallusers(); 
            $data['sess'] = $this->Admins->getuser($id);
            // Pass the user data and load view 
            //$this->load->view('admin/header', $data); 
            $this->load->view('admin/tables', $data); 
            //$this->load->view('admin/footer'); 
        }else{ 
            redirect('admin'); 
        } 
    } 
 
    public function login(){ 
        $data = array(); 
         
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
                        'email'=> $this->security->xss_clean($this->input->post('email')), 
                        'password' => $this->security->xss_clean(md5($this->input->post('password'))),
                        'status' => 1 
                    ) 
                ); 
                $checkLogin = $this->Admins->getRows($con); 
                if($checkLogin){ 
                    $this->session->set_userdata('isUserLoggedIn', TRUE); 
                    $this->session->set_userdata('userId', $checkLogin['id']); 
					//$this->load->view('admin/dashboard', $data);
                    redirect('admin/dashboard'); 
                }else{ 
                    $data['error_msg'] = 'Wrong email or password, please try again.'; 
					
                } 
            }else{ 
                //$data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
		 $data['title'] = 'Login';
         $this->load->view('admin/login', $data);
        // Load view 
       // $this->load->view('admin/header', $data); 
         
       // $this->load->view('admin/footer'); 
    } 
 
    public function adduser(){ 
        $data = array(); 
        //if($this->isUserLoggedIn){ 
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
        /* }else{ 
            redirect('admin'); 
        }  */
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
	
	public function addproject(){ 
        $data = array(); 
        if($this->isUserLoggedIn){ 
			$id = $this->session->userdata('userId');
			$data['title'] = 'Add Project';
			
			if($this->input->post('projectSubmit')){ 
            $this->form_validation->set_rules('title', 'Title', 'required|callback_project_check'); 
            $this->form_validation->set_rules('desc', 'Description', 'required'); 
			$projectData = array( 
                'title' => strip_tags($this->input->post('title')), 
                'desc' => strip_tags($this->input->post('desc'))				
            ); 
 
            if($this->form_validation->run() == true){ 
                $insert = $this->Admins->insertproject($projectData); 
				
                if($insert){ 
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('admin/addproject'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{ 
                //$data['error_msg'] = 'Please fill all the mandatory fields.'; 
            }
		}
		$this->load->view('admin/addproject', $data);
		}else{ 
            redirect('admin'); 
        } 
		
	}
	
	public function project_check($str){ 
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'title' => $str 
            ) 
        ); 
        $checkEmail = $this->Admins->getprojectRow($con); 
        if($checkEmail > 0){ 
            $this->form_validation->set_message('project_check', 'The given project already exists.'); 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    }
	
	public function logout(){ 
        $this->session->unset_userdata('isUserLoggedIn'); 
        $this->session->unset_userdata('userId'); 
        $this->session->sess_destroy(); 
        redirect('admin'); 
    } 
	
	public function projects(){ 
        $data = array(); 
        if($this->isUserLoggedIn){  
			$id = $this->session->userdata('userId');
			$data['title'] = 'Projects';
            $data['user'] = $this->Admins->getallprojects(); 
            $data['sess'] = $this->Admins->getuser($id);
            $this->load->view('admin/projects', $data);  
        }else{ 
            redirect('admin'); 
        } 
    } 
      
}