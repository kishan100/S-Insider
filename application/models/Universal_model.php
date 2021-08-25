<?php
class Universal_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

		$query = $this->db->get('tbl_admin'); 
		$result = $query->row();
		$this->config->set_item('contact_email',$result->contact_email);
		$this->config->set_item('admin_per_page_record',$result->admin_per_page_record);
		$this->config->set_item('front_per_page_record',$result->front_per_page_record);
		$this->config->set_item('site_name',$result->site_name);
		$this->config->set_item('phone_number',$result->phone_number);
		$this->config->set_item('address',$result->address);
		$this->config->set_item('facebook_url',$result->facebook_url);
		$this->config->set_item('twitter_url',$result->twitter_url);
		$this->config->set_item('youtube_url',$result->youtube_url);
		$this->config->set_item('google_url',$result->google_url);
		$this->config->set_item('copyright_text',$result->copyright_text);
		$this->config->set_item('site_logo',$result->site_logo);
	}
}
?>
