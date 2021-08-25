<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_account extends CI_Controller {
/*  file User_account.php */
/* Location: ./application/controllers/User_account.php */
/* Developer Nirmal lohar
 * Created On 3.40 PM 5 March 2017
 * purpose :- User dashboard functionality 
 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_account_model'); 
		$this->load->model('category_model');  // Used in header_inner file for get menu list
		//Logged in member
		$this->member_id = $this->session->userdata('memberId');
		
		}

	/*---------------------------------------------
		Webiste default page / Site Home page 
		Developer: Nirmal Lohar
		Date: 05 Mar 2017
		Purpose:User Dashboard 
	-----------------------------------------------*/

	public function index()
	{
		$output['pagename'] = 'dashboard';
		$output['recentNews'] = $this->news_model->getRecentNews();
		$output['userDetail'] = $this->user_account_model->getUserDetailById($this->member_id);
		if(empty($output['userDetail'])){
			redirect('logout');
		}
		$this->load->view($this->config->item('defaulFolderName').'/header_inner',$output);
		$this->load->view($this->config->item('defaulFolderName').'/myaccount/dashboard');
		$this->load->view($this->config->item('defaulFolderName').'/footer');
	}

	public function accountSetting()
	{
		$output['userDetail'] = $userDetail = $this->user_account_model->getUserDetailById($this->member_id);
		if(!empty($_POST))
		{
			$errorMsg='';
			$success_message='';
			$failure ='';
			$temp ='';
			$filename =null;
			#===================== Form validation Start=================#
			$this->form_validation->set_rules('name','Full name','required|trim');
			$this->form_validation->set_rules('mobile_number','Mobile','required|trim|max[10]');
			$this->form_validation->set_rules('state_id','State','trim');
			$this->form_validation->set_rules('city_id','City','trim');
			$this->form_validation->set_rules('dob','Date of birth','trim');
			if($this->form_validation->run())
			{ 
				#============Upload Image ===========#
				if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
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
					if ( ! $this->upload->do_upload('image'))
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
			
			if($temp=true)
				{
					$this->user_account_model->updateProfile($this->member_id,$filename);
					$success_message .= 'Your profile updated successfully.';
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
					$data['url'] = site_url('dashboard');
				}
				$data['scrollToThisForm']=true;
				echo json_encode($data);die;
			}
		}
		
		$this->load->model_admin('location_model');
		$output['states'] = $this->location_model->getStatesByCountry('101');
		$output['pagename'] = 'account-setting';
		$output['recentNews'] = $this->news_model->getRecentNews();
		$this->load->view($this->config->item('defaulFolderName').'/header_inner',$output);
		$this->load->view($this->config->item('defaulFolderName').'/myaccount/account_setting');
		$this->load->view($this->config->item('defaulFolderName').'/footer');
	}
	
	public function changePassword()
	{
		if(!empty($_POST))
		{
			$errorMsg='';
			$failure ='';
			#===================== Form validation Start=================#
			$this->form_validation->set_rules('opass','Old password','required|trim');
			$this->form_validation->set_rules('npass','New password','required|trim');
			$this->form_validation->set_rules('cpass','Confirm password','required|trim|matches[npass]');
			if($this->form_validation->run())
			{ 
				$result = $this->user_account_model->changePassword($this->member_id);
				if($result == true)
				{	
					$success_message = "You have successfully change password";
				}
				else
				{
					$failure = true;
					$errorMsg .= 'Your old passsword does not match.Please enter correct password.';
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
					$data['resetForm']=true;
					$data['success_message'] = $success_message;
				}
				$data['scrollToThisForm']=true;
				echo json_encode($data);die;
			}
		}
		
		$output['pagename'] = 'change-password';
		$output['recentNews'] = $this->news_model->getRecentNews();
		$output['userDetail'] = $this->user_account_model->getUserDetailById($this->member_id);
		$this->load->view($this->config->item('defaulFolderName').'/header_inner',$output);
		$this->load->view($this->config->item('defaulFolderName').'/myaccount/change_password');
		$this->load->view($this->config->item('defaulFolderName').'/footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
