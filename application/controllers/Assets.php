<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assets extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->data['page_title']='Assets';
        $this->load->library('session');
		$this->load->model('assets_model');
		$this->member_id = $this->session->userdata('memberId');
		if(!$this->session->userdata('memberId')){
			redirect('login', 'refresh');
		}
		if($_SESSION['roleId']==3){
			redirect('dashboard', 'refresh');
		}
    }
	
	public function index()
	{
		$data = $this->data;
		$data['assets'] = $this->assets_model->get_assets();
		$this->load->view('assets/index', $data);
	}
	
	public function create()
	{
		$data = $this->data;
		if(!empty($_POST))
		{
			$errorMsg='';
			$failure ='';
			#===================== Form validation Start=================#
		
			$this->form_validation->set_rules('asset_name','Asset Name','required|trim');
			$this->form_validation->set_rules('manufacturer','Manufacturer','required|trim');
			if($this->form_validation->run())
			{ 
				$post_data = array(
					'asset_name' 		=> 	$this->input->post('asset_name'),
					'asset_type' 		=> 	$this->input->post('asset_type'),
					'manufacturer' 		=> 	$this->input->post('manufacturer'),
					'serial_number1' 	=> 	$this->input->post('serial_number1'),
					'serial_number2' 	=> 	$this->input->post('serial_number2'),
					'additional_info' 	=> 	$this->input->post('additional_info'),
					'status' 			=> 	'In Stock',
					'created_at' 		=> 	date('Y-m-d H:i:s'),
					'updated_at' 		=> 	date('Y-m-d H:i:s')
				);
				$this->assets_model->create($post_data);
				$success_message = 'Assets created successfully!';
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
		
		$this->load->view('assets/create', $data);
	}
	
	public function edit($asset_id)
	{
		$data = $this->data;
		
		if(!empty($_POST))
		{
			$errorMsg='';
			$failure ='';
			#===================== Form validation Start=================#
		
			$this->form_validation->set_rules('asset_name','Asset Name','required|trim');
			$this->form_validation->set_rules('manufacturer','Manufacturer','required|trim');
			if($this->form_validation->run())
			{ 
				$post_data = array(
					'asset_name' 		=> 	$this->input->post('asset_name'),
					'asset_type' 		=> 	$this->input->post('asset_type'),
					'manufacturer' 		=> 	$this->input->post('manufacturer'),
					'serial_number1' 	=> 	$this->input->post('serial_number1'),
					'serial_number2' 	=> 	$this->input->post('serial_number2'),
					'additional_info' 	=> 	$this->input->post('additional_info'),
					'status' 			=> 	'In Stock',
					'updated_at' 		=> 	date('Y-m-d H:i:s')
				);
				$this->assets_model->update($post_data, $asset_id);
				$success_message = 'Assets updated successfully!';
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
		$data['asset'] = $this->assets_model->get_asset($asset_id);
		$this->load->view('assets/edit', $data);
	}
	
	public function delete()
	{
		$del_id = $this->input->post('del_id', true);
		if($del_id){
			$res = $this->assets_model->delete($del_id);
			echo $res;
		}
	}
	
}
