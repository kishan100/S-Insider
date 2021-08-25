<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->checkLgin();
		$output = array();
		$output['SITE_TITLE'] = 'Welcome on '.$this->config->item('AppName');
		$output['SITE_DESC'] = 'Welcome on '.$this->config->item('AppName');
		$output['SITE_KEYWORD'] = 'Welcome on '.$this->config->item('AppName');
		$output['total_users'] =	$this->db->get('users')->num_rows();
		$output['total_registered_users'] =	$this->db->where('is_registered',1)->get('users')->num_rows();
		$output['total_assets'] =	$this->db->get('assets')->num_rows();
		$output['total_assigned_assets'] =	$this->db->get('employee_assets')->num_rows();	
		$this->load->view('header',$output);
		$this->load->view('dashboard');
		$this->load->view('footer');
	}
	
	function checkLgin()
	{
		if(!$this->session->userdata('memberId')){
		redirect('login');
		}
	}
}
