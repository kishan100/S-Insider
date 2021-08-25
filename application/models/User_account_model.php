<?php
class User_account_Model extends CI_Model
{
/*  file User_account_model.php */
/* Location: ./application/models/User_account_model.php */
/* Developer Nirmal lohar
 * Created On 3.40 PM 5 March 2017
 * purpose :- User dashboard functionality 
 */
	public $tableuser ='tbl_users';
	
	#================================= Get Singe Record By Id ================================#
	function getUserDetailById($userId)
	{
		$this->db->select($this->tableuser.'.*,tbl_states.name as stateName,tbl_cities.name as cityName');
		$this->db->where($this->tableuser.'.id',$userId);
		$this->db->join('tbl_states','tbl_states.id='.$this->tableuser .'.state_id','LEFT');
		$this->db->join('tbl_cities','tbl_cities.id='.$this->tableuser .'.city_id','LEFT');
		$query = $this->db->get($this->tableuser);
		$record = $query->row();
		return $record;
	}
	#==================================Change password==================================#
	function changePassword($mem_id)
	{
		$this->db->where('id',$mem_id);
		$this->db->where('password',md5($this->input->post('opass')));
		$query = $this->db->get($this->tableuser);
		$row = $query->row();
		if(count($row) > 0){
			$this->db->where('id',$mem_id);
			$this->db->where('password',md5($this->input->post('opass')));
			$this->db->set('password',md5($this->input->post('npass')));
			$this->db->update($this->tableuser);
			return true;
		}else{
			return false;
		}
		
		$this->db->set('password',md5($this->input->post('npass')));
		$this->db->where('id',$mem_id);
		$this->db->where('password',md5($this->input->post('oldpass')));
		$this->db->update($this->tableuser);
	}

	#==================================Update Profile==================================#
	function updateProfile($mem_id,$filename)
	{
		$userDetail = $this->getUserDetailById($mem_id);
		$this->db->set('name',$this->input->post('name'));
		$this->db->set('mobile_number',$this->input->post('mobile_number'));
		$this->db->set('state_id',$this->input->post('state_id'));
		$this->db->set('city_id',$this->input->post('city_id'));
		$this->db->set('gender',$this->input->post('gender'));
		if($filename!=null)
		{
			$this->db->set('profile_pic',$filename);
			if($userDetail->profile_pic!='')
			@unlink('assets/uploads/member/'.$userDetail->profile_pic);
		}
		$this->db->set('dob',strtotime($this->input->post('dob')));
		$this->db->where('id',$mem_id);
		$this->db->update($this->tableuser);
	}
}
?>
