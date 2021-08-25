<?php
class Users_model extends CI_Model
{
	
	public $tablename ='users';
	
	function addUser($filename){
		if($this->input->post('name')){
		$this->db->set('name',$this->input->post('name'));
	//	$this->db->set('username',createUniqueSlug($this->input->post('name'),'users','username'));
		}
		$this->db->set('mobile_number',trim($this->input->post('mobile_number')));
		if($this->input->post('email'))
		$this->db->set('email',trim($this->input->post('email')));
		$this->db->set('designation',trim($this->input->post('designation')));
		$this->db->set('emp_code',trim($this->input->post('emp_code')));
		$this->db->set('joining_date',trim($this->input->post('joining_date')));
		$this->db->set('is_registered',0);
		//$this->db->set('password',md5($this->input->post('password')));\
		$this->db->set('profile_img',$filename);
		$this->db->set('updated',time());
		$this->db->set('created',time());
	//	$this->db->set('ip_address',$this->input->ip_address());
		$this->db->insert($this->tablename);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	function getRecords($roleId='')
	{		
		$this->db->select('*');
		if(!empty($roleId) && $roleId==3){
			$this->db->where('role_id',3);
			$this->db->where('id',$_SESSION['memberId']);
		}
		$query = $this->db->get($this->tablename);
		$record = $query->result();
		return $record;
	}
	function getPageRecordsById($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		
		$query = $this->db->get($this->tablename);
		$record = $query->row();
		return $record;
	}
	function performtask($task,$id)
	{
		if($task=='delete')
			{
				$userRecord = $this->getPageRecordsById($id);
				if($userRecord->is_registered==true){
					$data['success'] = false; 
					$data['message'] = 'Sorry Registered users can not be deleted.';
				}else{
					$this->db->where('id',$id);
					$this->db->where('id','!=',$_SESSION['memberId']);
					$query = $this->db->delete($this->tablename);
					$data['success'] = true; 
					$data['message'] = 'Selected record successfully deleted';
				
				}
				
			}
		else
			{
				$this->db->where('id',$id);
				$this->db->set('status',$task);
				$query = $this->db->update($this->tablename);
				$data['success'] = true; 
				$data['message'] =  'Status of selected record successfully changed';
			}
		return $data;
	}
	function update($id,$filename)
	{
		$record = $this->getPageRecordsById($id);
			if($this->input->post('name')){
			$this->db->set('name',$this->input->post('name'));
			}
			$this->db->set('mobile_number',trim($this->input->post('mobile_number')));
			if($this->input->post('email') && $_SESSION['memberId']!=$id)
			$this->db->set('email',trim($this->input->post('email')));
			$this->db->set('designation',trim($this->input->post('designation')));
			$this->db->set('emp_code',trim($this->input->post('emp_code')));
			$this->db->set('joining_date',trim($this->input->post('joining_date')));
			$this->db->set('profile_img',$filename);
			$this->db->set('updated',time());
		
			if($filename)
			{
				@unlink('assets/uploads/member/'.$record->profile_img);
				$this->db->set('profile_img',$filename);
		}
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
}
?>
