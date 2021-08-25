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
	}
	
	public function index()
	{
		$output = array();
		$output['users'] =$this->users_model->getRecords();
		$this->load->view('/header',$output);
		$this->load->view('/users');
		$this->load->view('/footer');
	}
	
	public function login()
	{
		$output = array();
		$output['SITE_TITLE'] = 'Login on '.$this->config->item('AppName');
		$output['SITE_DESC'] = 'Login on '.$this->config->item('AppName');
		$output['SITE_KEYWORD'] = 'Login on '.$this->config->item('AppName');
		$this->checkLgin();
		if(!$this->session->tempdata('REDIRECT_URL')){
			$this->session->set_tempdata('REDIRECT_URL',$this->agent->referrer());
		}
		
		if(!empty($_POST))
		{
			$errorMsg='';
			$failure ='';
			#===================== Form validation Start=================#
		
			$this->form_validation->set_rules('username','Email / Mobile No','required|trim');
			$this->form_validation->set_rules('password','Password','required|trim');
			if($this->form_validation->run())
			{ 
				$result = $this->auth_model->checkForLgin();
				if(!empty($result))
				{	
					$this->session->set_userdata('memberId',$result->id);
					$this->session->set_userdata('memberName',$result->name);
					$this->session->set_userdata('memberEmail',$result->email);
					if($result->mobile_number!=''){
						$this->session->set_userdata('mobno',$result->mobile_number);
					}
					$success_message = "You have successfully logged in";
				}
				else
				{
					$failure = true;
					$errorMsg .= 'Please enter correct login detail';
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
					if($this->session->tempdata('REDIRECT_URL'))
					$data['url']=$this->session->tempdata('REDIRECT_URL');
					else
					$data['url']=site_url('');
					$data['success_message'] = $success_message;
				}
				$data['scrollToThisForm']=true;
				echo json_encode($data);die;
			}
		}
	//	$this->load->view('/header',$output);
		$this->load->view('/login',$output);
	//	$this->load->view('/footer');
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
	
	/* Google login */
	public function googleLogin()
	{
	
		
	}
	
	public function facebookLogin()
	{
	
	}
	
	
	function mobileCallback()
	{
		$mobile = substr($this->input->post('mobile'),0,3);
		$invalidMobArr = array('111',222,333,444,555,666,777,888,999,000,012,123);
		if(in_array($mobile,$invalidMobArr)){
			$this->form_validation->set_message('mobileCallback',"Invalid mobile number");
			return false;
		} else {
			return true;
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

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
/* Developer Akhilesh joshi */
