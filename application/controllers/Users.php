<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
/*  file Auth.php */
/* Location: ./application/controllers/Auth.php */
/* Developer Akhilesh joshi
 * Created On 12:01 AM 20 Aug 2021
 * purpose :- user authontication for login signup etc 
 */
	function __construct()
	{
		parent::__construct();
		$this->checkLgin();
		$this->load->model('users_model');
	//	echo `whoami`; die;
	}
	
	public function index()
	{
		//print_r($_SESSION);
		$output = array();
		$output['users'] =$this->users_model->getRecords($_SESSION['roleId']);
		$this->load->view('/header',$output);
		$this->load->view('/users');
		$this->load->view('/footer');
	}
	
	public function addUser()
	{
		$output = array();
		if(!empty($_POST))
		{
			$errorMsg='';
			$success_message='';
			$failure ='';
			$temp =false;
			$filename =null;
			#===================== Form validation Start=================#
			$this->form_validation->set_rules('name','Name','required|trim');
			$this->form_validation->set_rules('mobile_number','Mobile No.','required|trim');
			$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('emp_code','Employee Code','trim');
			$this->form_validation->set_rules('designation','Designation','trim');
			$this->form_validation->set_rules('joining_date','Joining Date','trim');
			if($this->form_validation->run() && $_SESSION['roleId']!=3)
			{ 
				$temp =true;
				#============Upload Image ===========#
				if(isset($_FILES['profile_img']['name']) && $_FILES['profile_img']['name']!='')
				{
					@mkdir('./assets/uploads/member/',0777,true);
					@chmod('./assets/uploads/member/',0777);
					$config['upload_path'] = './assets/uploads/member/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['encrypt_name'] = true;
					//$config['max_size']	= '1000';
					//$config['max_width']  = '1024';
					//$config['max_height']  = '768';
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('profile_img'))
					{
						$error = array('error' => $this->upload->display_errors());
						$errorMsg.= $error['error'];
						$failure = true;
						$temp=false;
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());
						$filename = $data['upload_data']['file_name'];
					}
				
				}
			}else{
				$failure = true;
				$errorMsg.= validation_errors();
			}
			
			if($temp==true)
				{
					$this->users_model->addUser($filename);
					$success_message .= 'Employee added successfully.';
				}
					
			if($this->input->is_ajax_request())
			{
				if($failure)
				{
					$data['success']=false;
					$data['error_message']=$errorMsg;
				}
				else
				{
					$data['success']=true;
					$data['success_message'] = $success_message;
					$data['url'] = site_url('users');
				}
				$data['scrollToThisForm']=true;
				echo json_encode($data);die;
			}
		}
		$this->load->view('/header',$output);
		$this->load->view('/adduserform');
		$this->load->view('/footer');
	}

	public function edit($id)
	{
		$output['taskData']=$record = $this->users_model->getPageRecordsById($id);
		$output['page_heading']='Update User';
		if(!empty($_POST))
		{
			$error='';
			$failure=false;
			$errorMsg = '';
			#===================== Form validation Start=================#
			$this->form_validation->set_rules('name','Name','required|trim');
			$this->form_validation->set_rules('mobile_number','Mobile No.','required|trim');
			if($this->input->post('email')!=$record->email)
			$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
			else
			$this->form_validation->set_rules('email','Email','required|trim|valid_email');
			
			$this->form_validation->set_rules('emp_code','Employee Code','trim');
			$this->form_validation->set_rules('designation','Designation','trim');
			$this->form_validation->set_rules('joining_date','Joining Date','trim');
		
			if($this->form_validation->run())
			{
				$filename = null;
				if(@$_FILES['profile_img']['name']!='')
				{
					@mkdir('./assets/uploads/member/',0777,true);
					@chmod('./assets/uploads/member/',0777);
					$config['upload_path'] = './assets/uploads/member/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['encrypt_name'] = true;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('profile_img'))
					{
						$error = array('error' => $this->upload->display_errors());
						$errorMsg.= $error['error'];
						$temp=false;
						$failure = true;
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());
						$filename = $data['upload_data']['file_name'];
					}
				}
				$this->users_model->update($id,$filename);
				$success_message = "User has been succesfully Updated.";
			}
			else
			{
				$failure = true;
				$errorMsg.= validation_errors();
			}
			if($this->input->is_ajax_request())
			{
				if($failure)
				{
					$data['success']=false;
					$data['error_message']=$errorMsg;
				}
				else
				{
					$data['success']=true;
					$data['resetForm'] = true;
					$data['success_message'] = $success_message;
				}
				$data['scrollToThisForm']=true;
				echo json_encode($data);die;
			}
		}
		
		$this->load->view('/header',$output);
		$this->load->view('/adduserform');
		$this->load->view('/footer');
	}

	public function forgetPassword()
	{
		$this->checkLgin();
		$output = array();
		if(!empty($_POST))
		{
			$errorMsg='';
			$failure ='';
			$member_id = 0;
			$quantity = 0;
			$data = array();
			$member_data = array();
			
			#===================== Form validation Start=================#
			$this->form_validation->set_rules('email','Email','required|trim|valid_email');
			if($this->form_validation->run())
			{
				$result = $this->auth_model->getRecordByEmail($this->input->post('email'));
				if(!empty($result))
				{
					$this->auth_model->setForgetPassswordToken($this->input->post('email'));
					$success_message = "A reset password link send on your email address";
				}
				else
				{
					$failure = true;
					$errorMsg .= 'Your email address have not found';
				}
			}
			else
			{
				$failure = true;
				$errorMsg.= validation_errors();
			}
			if($this->input->is_ajax_request())
			{
				if($failure)
				{
					$data['success']=false;
					$data['error_message']=$errorMsg;
				}
				else
				{
					$data['success']=true;
					$data['url']= site_url('');
					$data['success_message'] = $success_message;
				}
				$data['scrollToThisForm']=true;
				echo json_encode($data);die;
			}
		}
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
	
	function checkLgin()
	{
		if(!$this->session->userdata('memberId')){
			redirect('login');
		}
	}

		#=========================Delete Record====================================#
		public function performTask($task,$id)
		{
			$success_data = $this->users_model->performtask($task,$id);
			if($success_data['success']){
				$data['success']=true;
				$data['success_message'] = $success_data['message'];
			} else{
				$data['success']=false;
				$data['success_message'] = $success_data['message'];
			}
			
			$data['scrollToThisForm']=true;
			echo json_encode($data);die;
		}
		
		#==========================================================================#
		#=========================View Record====================================#
		public function view($id)
		{
			$output['record'] = $this->users_model->getPageRecordsById($id);
			echo $this->load->view('user_detail_view',$output,TRUE); 
		}
		#==========================================================================#

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
/* Developer Akhilesh joshi */
