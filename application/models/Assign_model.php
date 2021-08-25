<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Assign_model extends CI_Model {	

	function create($data=array()){
		$this->db->trans_start();
		$this->db->insert('employee_assets',$data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}	

	function update($data=array(), $employee_asset_id){
		$this->db->where('employee_asset_id', $employee_asset_id);
		$this->db->update('employee_assets', $data);
		return true;
	}	

	function get_assign($employee_asset_id){
		$query = $this->db->query("SELECT * FROM employee_assets WHERE employee_asset_id = '" . (int)$employee_asset_id . "' ");
		return $query->row();
	}	

	function get_assigns($data=array()){
		$sql = "SELECT employee_assets.*,users.name as username,users.email as useremail,assets.asset_name FROM employee_assets 
		LEFT JOIN users ON users.id=employee_assets.employee_id
		LEFT JOIN assets ON assets.asset_id=employee_assets.asset_id
		WHERE 1=1";
		if(!empty($data['roleId']) && $data['roleId']==3){
			$sql .= ' AND employee_assets.employee_id = "'.$_SESSION['memberId'].'"';
		}
		if(!empty($data['roleId']) && $data['roleId']!=3){
			if(!empty($data['request_type']) && $data['request_type']=='pending_requests'){
				$sql .= ' AND (employee_assets.status = "Pending")';
			}else{
				$sql .= ' AND (employee_assets.status = "Approved" OR employee_assets.status = "Cancelled")';
			}
		}
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return array();
		}
	}

	function get_users($data=array()){
		$sql = "SELECT * FROM users WHERE 1=1";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return array();
		}
	}

	function get_assets($data=array()){
		$sql = "SELECT * FROM assets WHERE 1=1";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return array();
		}
	}	

	public function get_total_asset($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM employee_assets ";
		$query = $this->db->query($sql);
		return $query->row()->total;
	}	

	function delete($employee_asset_id){
		$this->db->where('employee_asset_id', $employee_asset_id);
		$this->db->delete('employee_assets');
		return true;
	}

}

?>