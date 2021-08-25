<?php
class Auth_model extends CI_Model
{
	
	public $tablename ='users';
	
	function register_user(){
		$record =$this->getRecordByEmail($this->input->post('email'));
		if($record){
			$this->db->set('is_registered',1);
			$this->db->set('password',md5($this->input->post('password')));
			$this->db->set('updated',time());
			$this->db->where('id',$record->id);
			$this->db->update($this->tablename);

		} else{
			if($this->input->post('name')){
				$this->db->set('name',$this->input->post('name'));
				}
				$this->db->set('mobile_number',trim($this->input->post('mobile')));
				if($this->input->post('email'))
				$this->db->set('email',trim($this->input->post('email')));
				$this->db->set('is_registered',1);
				$this->db->set('password',md5($this->input->post('password')));
				$this->db->set('created',time());
				$this->db->insert($this->tablename);
				$insert_id = $this->db->insert_id();
				$record =$this->getRecordByEmail($this->input->post('email'));
		}
		
		return $record;
	}
	function checkForLgin()
	{
		$this->db->select('*');
		$where  = "(email = '".$this->input->post('username')."' || mobile_number = '".$this->input->post('username')."')";
		$this->db->where($where);
		$this->db->where('password',md5($this->input->post('password')));
	//	$this->db->where('approve_status','Approved');
		$query = $this->db->get($this->tablename);
		$record = $query->row();
		return $record;
	}
	function getRecordByEmail($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);
	//	$this->db->where('approve_status','Approved');
		$query = $this->db->get($this->tablename);
		$record = $query->row();
		return $record;
	}
	
	function checkForFacebookLogin($facebookId)
	{
	}
	function checkForGoogleLogin($googleId)
	{
	}
	
	
	function setForgetPassswordToken($email){
		return true;
		$token = uniqid();
		//set here request to change password string and send mail to user
		}
}
?>
