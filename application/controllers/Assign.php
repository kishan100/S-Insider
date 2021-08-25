<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->data['page_title']='Assign';
        $this->load->library('session');
		$this->load->model('assign_model');
		$this->member_id = $this->session->userdata('memberId');
		if(!$this->session->userdata('memberId')){
			redirect('login', 'refresh');
		}
		/*if($_SESSION['roleId']==3){
			redirect('dashboard', 'refresh');
		}*/
    }
	
	public function index()
	{
		$data = $this->data;
		$data['assigns'] = $this->assign_model->get_assigns(array('roleId'=>$_SESSION['roleId']));
		$this->load->view('assign/index', $data);
	}
	
	public function pending_requests()
	{
		$data = $this->data;
		$data['assigns'] = $this->assign_model->get_assigns(array('roleId'=>$_SESSION['roleId'],'request_type'=>'pending_requests'));
		$this->load->view('assign/index', $data);
	}
	
	public function create()
	{
		$data = $this->data;
		if(!empty($_POST))
		{
			$errorMsg='';
			$failure ='';
			#===================== Form validation Start=================#
		
			$this->form_validation->set_rules('asset_type','Asset Type','required|trim');
			//$this->form_validation->set_rules('user','User','required|trim');
			if($this->form_validation->run())
			{ 
				$post_data = array(
					'employee_id' 		=> 	$_SESSION['memberId'], //$this->input->post('user'),
					'asset_id' 			=> 	$this->input->post('asset_type'),
					'request_reason' 	=> 	$this->input->post('request_reason'),
					'status' 			=> 	'Pending',//$this->input->post('status'),
					'created_at' 		=> 	date('Y-m-d H:i:s'),
					'updated_at' 		=> 	date('Y-m-d H:i:s')
				);
				$this->assign_model->create($post_data);
				$success_message = 'Assets assign successfully!';
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
		$data['users'] = $this->assign_model->get_users();
		$data['assets'] = $this->assign_model->get_assets();
		
		$this->load->view('assign/create', $data);
	}
	
	public function edit($assign_id)
	{
		if($_SESSION['roleId']==3){
			redirect('dashboard', 'refresh');
		}
		$data = $this->data;
		
		if(!empty($_POST))
		{
			$errorMsg='';
			$failure ='';
			#===================== Form validation Start=================#
		
			$this->form_validation->set_rules('asset_type','Asset Type','required|trim');
			//$this->form_validation->set_rules('user','User','required|trim');
			if($this->form_validation->run())
			{ 
				$post_data = array(
					//'employee_id' 		=> 	$this->input->post('user'),
					'asset_id' 				=> 	$this->input->post('asset_type'),
					'admin_note' 			=> 	$this->input->post('admin_note'),
					'status' 				=> 	$this->input->post('status'),
					'updated_at' 			=> 	date('Y-m-d H:i:s')
				);
				$this->assign_model->update($post_data, $assign_id);
				$success_message = 'Assets assign updated successfully!';
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
		$data['assign'] = $this->assign_model->get_assign($assign_id);
		$data['users'] = $this->assign_model->get_users();
		$data['assets'] = $this->assign_model->get_assets();
		$this->load->view('assign/edit', $data);
	}
	
	public function delete()
	{
		if($_SESSION['roleId']==3){
			redirect('dashboard', 'refresh');
		}
		$del_id = $this->input->post('del_id', true);
		if($del_id){
			$res = $this->assign_model->delete($del_id);
			echo $res;
		}
	}
	
}
